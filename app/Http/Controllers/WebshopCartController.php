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
        dd(session()->get('cart'));
    }

    public function add(Request $request, WebshopProduct $webshopProduct)
    {
        Cart::Add($webshopProduct->id, $webshopProduct->title, 1, $webshopProduct->price, $request->get('filters')); // ID, TITLE, QTY, PRICE, FILTERS

        return redirect()->back()->with('message', 'Product geplaatst in de winkelwagen.');
    }

    public function truncate()
    {
        Cart::truncate();

        return redirect()->back()->with('message', 'Winkelwagen geleegd.');
    }
}
