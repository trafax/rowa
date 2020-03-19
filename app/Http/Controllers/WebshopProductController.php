<?php

namespace App\Http\Controllers;

use App\Models\WebshopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebshopProductController extends Controller
{
    public function index($slug)
    {
        $webshopProduct = WebshopProduct::where('slug', $slug)->firstOrFail();

        // Afgeschermde producten alleen tonen voor de gekoppelde gebruikers
        if ($webshopProduct->users->count() > 0 && ! @in_array(Auth::user()->id, $webshopProduct->users()->pluck('id')->toArray())) {
            abort(404);
        }

        $filters = function() use ($webshopProduct) {

            $filterArr = [];

            foreach ($webshopProduct->filters as $filter)
            {
                if ($filter->selectable == 1)
                {
                    $filterArr[$filter->slug][] = [
                        'title' => $filter->title,
                        'slug' => $filter->pivot->slug,
                        'fixed_price' => $filter->pivot->fixed_price,
                        'added_price' => $filter->pivot->added_price,
                        'value' => $filter->pivot->value
                    ];
                }
            }

            return $filterArr;
        };

        return view('webshop.products.index')->with([
            'webshopProduct' => $webshopProduct,
            'filters' => $filters()
        ]);
    }
}
