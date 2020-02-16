<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Order;
use App\Models\WebshopOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebshopOrderController extends Controller
{
    public function index()
    {
        $orders = WebshopOrder::orderByRaw('CAST(order_nr as UNSIGNED) DESC')->get();

        return view('webshop.orders.admin.index')->with('orders', $orders);
    }

    public function show(WebshopOrder $webshopOrder)
    {
        $order = new Order($webshopOrder);
        $email = $order->build()->html;

        return view('webshop.orders.admin.show')->with('order', $webshopOrder)->with('email', $email);
    }
}
