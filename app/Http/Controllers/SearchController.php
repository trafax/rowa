<?php

namespace App\Http\Controllers;

use App\Models\WebshopProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $products = WebshopProduct::where('title', 'like', '%'.$request->get('search').'%')->orWhere('sku', 'like', '%'.$request->get('search').'%')->get();

        return view('search.index', ['products' => $products]);
    }
}
