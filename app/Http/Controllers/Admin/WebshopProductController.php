<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebshopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WebshopProductController extends Controller
{
    public function index()
    {
        $objects = WebshopProduct::get();

        return view('webshop.products.admin.index')->with('objects', $objects);
    }

    public function create()
    {
        return view('webshop.products.admin.create');
    }

    public function store(Request $request)
    {
        $webshopProduct = new WebshopProduct();
        $request->request->set('slug', Str::slug($request->get('title')));
        $webshopProduct->fill($request->all());
        $webshopProduct->save();

        self::attach_filters($webshopProduct, $request);

        return redirect()->route('admin.webshopProduct.index')->with('message', 'Product succesvol aangemaakt.');
    }

    public function edit(Request $request, WebshopProduct $webshopProduct)
    {
        return view('webshop.products.admin.edit')->with('object', $webshopProduct);
    }

    public function update(Request $request, WebshopProduct $webshopProduct)
    {
        $request->request->set('slug', Str::slug($request->get('title')));
        $webshopProduct->fill($request->all());
        $webshopProduct->save();

        self::attach_filters($webshopProduct, $request);

        return redirect()->route('admin.webshopProduct.index')->with('message', 'Product succesvol gewijzigd.');
    }

    public function attach_filters($webshopProduct, $request)
    {
        $webshopProduct->filters()->detach();

        foreach ($request->get('variation') as $filter_id => $filter)
        {
            $filterRulesArr = explode("\r\n", $filter);
            foreach ($filterRulesArr as $key => $filterRule)
            {
                list($value, $fixed_price, $added_price) = array_pad(explode(',', $filterRule), 3, 0);

                if (! $value) continue;

                $value = trim($value, ' ');
                $fixed_price = number_format($fixed_price);
                $added_price = number_format($added_price);

                $webshopProduct->filters()->attach($filter_id, [
                    'id' => Str::uuid(),
                    'sort' => $key,
                    'value' => $value,
                    'slug' => Str::slug($value),
                    'fixed_price' => $fixed_price,
                    'added_price' => $added_price
                ]);
            }
        }
    }

    public function delete_selected(Request $request)
    {
        WebshopProduct::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde producten succesvol verwijderd.');

        echo 1;
    }
}
