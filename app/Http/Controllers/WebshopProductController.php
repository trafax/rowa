<?php

namespace App\Http\Controllers;

use App\Models\WebshopProduct;
use Illuminate\Http\Request;

class WebshopProductController extends Controller
{
    public function index($slug)
    {
        $webshopProduct = WebshopProduct::where('slug', $slug)->firstOrFail();

        return view('webshop.products.index')->with([
            'webshopProduct' => $webshopProduct
        ]);
    }
}
