<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use App\Models\WebshopOrder;
use App\Models\WebshopOrderRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'privacy' => 'required'
        ]);

        // Nieuwe order aanmaken als deze nog niet opgeslagen is
        if (! session()->get('order'))
        {
            $order = new WebshopOrder();
            $order->user_id = Auth::user()->id;

            $WebshopOrderNr = WebshopOrder::orderByRaw('CAST(order_nr as UNSIGNED) DESC')->first();
            $order->order_n = ($WebshopOrderNr->order_nr ?? 0) + 1;

            // Factuur adres
            $order->invoice_address = [
                'street' => Auth::user()->street,
                'house_number' => Auth::user()->house_number,
                'zipcode' => Auth::user()->zipcode,
                'city' => Auth::user()->city,
            ];

            // Sla aflever gegevens op
            if ($request->get('other_delivery') == 1)
            {
                $order->delivery_address = [
                    'street' => $request->get('delivery_street'),
                    'house_number' => $request->get('delivery_house_number'),
                    'zipcode' => $request->get('delivery_zipcode'),
                    'city' => $request->get('delivery_city'),
                ];

                $user = Auth::user();
                $user->other_delivery = 1;
                $user->delivery_street = $request->get('delivery_street');
                $user->delivery_house_number = $request->get('delivery_house_number');
                $user->delivery_zipcode = $request->get('delivery_zipcode');
                $user->delivery_city = $request->get('delivery_city');
                $user->save();
            }
            else
            {
                $user = Auth::user();
                $user->other_delivery = 0;
                $user->delivery_street = NULL;
                $user->delivery_house_number = NULL;
                $user->delivery_zipcode = NULL;
                $user->delivery_city = NULL;
                $user->save();
            }

            // Prijzen
            $order->price_sub_total = session()->get('cart.prices')['sub_total'];
            $order->price_total = session()->get('cart.prices')['total'];
            $order->price_shipping = session()->get('cart.prices')['shipping'];

            $order->save();

            // Product regels opslaan
            foreach (session()->get('cart')['items'] ?? [] as $key => $row)
            {
                $orderRule = new WebshopOrderRule();
                $orderRule->order_id = $order->id;
                $orderRule->user_id = Auth::user()->id;
                $orderRule->product_id = $row['id'];
                $orderRule->qty = $row['qty'];
                $orderRule->price = $row['price'];
                $orderRule->options = $row['options'];
                $orderRule->save();
            }

            session()->put('order', $order->toArray());
        }

        return redirect()->route('doPayment');
    }

    public function done()
    {
        return view('webshop.orders.done');
    }
}
