<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Auth::user())
        {
            return view('webshop.checkout.index');
        }
        else
        {
            return view('webshop.checkout.customer');
        }
    }

    public function doPayment()
    {
        return self::paymentDone();
    }

    public function sendEmail()
    {
        // E-mail versturen
        Mail::to(Auth::user()->email)->send(new Order(session()->get('order')));
    }

    public function paymentDone()
    {
        // TODO: Bestelling nog op betaald zetten, dit kan pas nadat iDeal ingebouwd is.
        self::sendEmail();
        return redirect()->route('order.done');
    }
}
