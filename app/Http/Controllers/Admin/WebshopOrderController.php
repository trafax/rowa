<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Order;
use App\Models\WebshopOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;

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

    public function delete_selected(Request $request)
    {
        WebshopOrder::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde bestellingen succesvol verwijderd.');

        echo 1;
    }

    public function download_pdf(WebshopOrder $webshopOrder)
    {
        $html = view('webshop.orders.admin.order_pdf', ['order' => $webshopOrder])->render();
        $pdf = PDF::loadHTML($html);
        //return $pdf->download('Bestelling '. $webshopOrder->order_nr .'.pdf');
        return $pdf->stream();
    }
}
