<?php

namespace App\Http\Controllers;

use App\Libraries\Cart;
use App\Models\WebshopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebshopCartController extends Controller
{
    public function index()
    {
        return view('webshop.cart.index');
    }

    public function add(Request $request, WebshopProduct $webshopProduct)
    {
        Cart::Add($webshopProduct->id, $webshopProduct->title, $request->get('qty'), $webshopProduct->price, $request->get('filters')); // ID, TITLE, QTY, PRICE, FILTERS

        return redirect()->back()->with('message', 'Product geplaatst in de winkelwagen.');
    }

    public function update(Request $request)
    {
        Cart::update($request->get('qty'));

        return redirect()->back()->with('message', 'Winkelwagen succesvol bijgewerkt.');
    }

    public function truncate()
    {
        Cart::truncate();

        return redirect()->back()->with('message', 'Winkelwagen geleegd.');
    }
}
