<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homepage()
    {
        $homeBlocks = Page::where('show_on_home', 1)->orderBy('sort')->get();
        $page = Page::where('slug', '/')->first();

        return view('pages.homepage')
            ->with([
                'homeBlocks' => $homeBlocks,
                'page' => $page
                ]);
    }

    public function index($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        return view('pages.page', ['page' => $page]);
    }
}
