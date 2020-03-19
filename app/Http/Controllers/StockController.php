<?php

namespace App\Http\Controllers;

use App\Mail\UserOrder;
use App\Mail\UserOrderOutOfStock;
use App\Models\OrderSubscription;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StockController extends Controller
{
    public function index()
    {
        return view('users.stock.index');
    }

    public function order(Request $request)
    {
        $order = [
            'user' => Auth::user()
        ];

        $order['out_of_stock'] = [];

        foreach ($request->get('qty') as $id => $qty)
        {
            if ($qty < 1) continue;

            $product = UserProduct::find($id);

            $order['rules'][] = [
                'product' => $product,
                'qty' => $qty
            ];

            // Voorraad van het product bijwerken
            $product->qty = $product->qty - ($qty * ($product->collie ?? 1));
            $product->save();

            if (($product->qty ?? 0) / ($product->collie ?? 1) <= $qty && $product->email_no_stock == 1)
            {
                $order['out_of_stock'][] =  $product;
            }
        }

        OrderSubscription::create([
            'id' => Str::uuid(),
            'user_id' => Auth::user()->id,
            'order_data' => $order
        ]);

        if (count($order['out_of_stock']) > 0)
        {
            Mail::to('info@rowa.nl')->send(new UserOrderOutOfStock($order));
        }

        Mail::to(Auth::user()->email)->send(new UserOrder($order));
        Mail::to('info@rowa.nl')->send(new UserOrder($order));

        return redirect()->route('user.stock.done');
    }

    public function done()
    {
        return view('users.stock.done');
    }
}
