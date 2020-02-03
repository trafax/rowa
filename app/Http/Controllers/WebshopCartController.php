<?php

namespace App\Http\Controllers;

use App\Libraries\Cart;
use App\Models\WebshopProduct;
use Illuminate\Http\Request;

class WebshopCartController extends Controller
{
    public function add(Request $request, WebshopProduct $webshopProduct)
    {
        Cart::Add($webshopProduct->id, $webshopProduct->title, 1, $webshopProduct->price, $request->get('filters')); // ID, TITLE, QTY, PRICE, FILTERS
    }
}
