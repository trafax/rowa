<?php

namespace App\Http\Controllers;

use App\Libraries\Cart;
use App\Models\WebshopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WebshopCartController extends Controller
{
    public function index()
    {
        return view('webshop.cart.index');
    }

    public function add(Request $request, WebshopProduct $webshopProduct)
    {
        $productImage = '';
        if ($webshopProduct->needs_image) {
            $request->validate([
                'file' => 'required|image'
            ]);

            $image = $request->file('file');
            $extension = $request->file('file')->guessExtension();
            //$imageName = $image->getClientOriginalName();
            $imageName = Str::uuid() . '.' . $extension;
            $image->move(public_path('assets/customers'),$imageName);
            $productImage = '/assets/customers/' . $imageName;
        }

        Cart::Add($webshopProduct->id, $webshopProduct->title, $request->get('qty'), $webshopProduct->price, $request->get('filters'), $productImage); // ID, TITLE, QTY, PRICE, FILTERS, IMAGE

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
