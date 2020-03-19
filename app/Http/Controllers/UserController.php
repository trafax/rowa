<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WebshopOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $webuser = Auth::user();

        return view('users.profile')->with('webuser', $webuser);
    }

    public function orders()
    {
        $orders = WebshopOrder::where('user_id', Auth::user()->id)->orderByRaw('CAST(order_nr as UNSIGNED) DESC')->get();

        return view('users.orders')->with('orders', $orders);
    }

    public function order_view($order_id)
    {
        $order = WebshopOrder::where('id', $order_id)->where('user_id', Auth::user()->id)->firstOrFail();

        return view('users.order')->with('order', $order);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->fill($request->all());
        $user->save();

        return redirect()->back()->with('message', 'Uw gegevens zijn succesvol opgeslagen.');
    }

    public function products()
    {
        $products = Auth::user()->products()->get();

        return view('users.products', [
            'products' => $products
        ]);
    }
}
