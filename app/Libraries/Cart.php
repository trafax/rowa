<?php

namespace App\Libraries;

class Cart
{
    public static function add()
    {
        list($id, $title, $qty, $price, $options) = func_get_args();

        session()->push('cart.items',
        [
            'id' => $id,
            'title' => $title,
            'qty' => $qty,
            'price' => $price,
            'options' => $options
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

