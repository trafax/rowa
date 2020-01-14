<?php

namespace App\Http\Controllers;

use App\Models\WebshopCategory;
use Illuminate\Http\Request;

class WebshopCategoryController extends Controller
{
    public function index($slug)
    {
        $webshopCategory = WebshopCategory::where('slug', $slug)->first();

        return view('webshop.categories.index')->with([
            'webshopCategory' => $webshopCategory
        ]);
    }
}
