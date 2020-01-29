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

        return redirect()->route('admin.webshopProduct.index')->with('message', 'Product succesvol gewijzigd.');
    }

    public function delete_selected(Request $request)
    {
        WebshopProduct::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde producten succesvol verwijderd.');

        echo 1;
    }
}
