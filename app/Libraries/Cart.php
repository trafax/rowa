<?php

namespace App\Libraries;

use App\Models\WebshopProduct;
use App\Models\WebshopProductFilter;

class Cart
{
    public static function add()
    {
        list($id, $title, $qty, $price, $options, $image) = func_get_args();

        // Extra prijs bovenop de basis prijs berekenen mocht een filter een meerprijs hebben
        $product = WebshopProduct::find($id);
        foreach ($options ?? [] as $option => $slug)
        {
            $filter = WebshopProductFilter::where('slug', $slug)->where('webshop_product_id', $product->id)->first();

            if ($filter->fixed_price > 0)
            {
                $price = $filter->fixed_price;
            }
            if ($filter->added_price > 0)
            {
                $price = $price + $filter->added_price;
            }
        }

        session()->push('cart.items',
        [
            'id' => $id,
            'title' => $title,
            'qty' => $qty,
            'price' => $price,
            'options' => $options,
            'image' => $image
        ]);

        self::calculate();
    }

    public static function update($quantities)
    {
        $items = [];
        foreach (session()->get('cart.items') as $key => $row)
        {
            $qty = $quantities[$key];

            if ($qty > 0)
            {
                $row['qty'] = $qty;
                $items[] = $row;
            }
        }

        session()->put('cart.items', $items);

        Cart::calculate();
    }

    public static function calculate()
    {
        $price = 0;

        foreach (session()->get('cart')['items'] ?? [] as $row)
        {
            $price += ($row['price'] * $row['qty']);
        }

        session()->put('cart.prices',
        [
            'sub_total' => $price,
            'tax' => 0,
            'shipping' => 0,
            'total' => $price
        ]);
    }

    public static function truncate()
    {
        session()->forget('cart');
    }
}

