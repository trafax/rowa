<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use App\Mail\OrderInvoice;
use App\Models\WebshopOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public $mollie;

    public function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_96zK8CWhAq6EpjG4MtbRaQTd43yUAG");
    }

    public function index()
    {
        if (Auth::user() && session()->get('cart')['items'])
        {
            $paymentMethods = $this->mollie->methods->all();
            return view('webshop.checkout.index', ['paymentMethods' => $paymentMethods]);
        }
        else
        {
            return view('webshop.checkout.customer');
        }
    }

    public function doPayment(Request $request)
    {
        $order = session()->get('order');

        switch($order['paymentMethod']) {
            case 'default':
                $method = \Mollie\Api\Types\PaymentMethod::IDEAL;
            break;
            case 'paypal':
                $method = \Mollie\Api\Types\PaymentMethod::PAYPAL;
            break;
            case 'creditcard':
                $method = \Mollie\Api\Types\PaymentMethod::CREDITCARD;
            break;
            default:
                $method = \Mollie\Api\Types\PaymentMethod::IDEAL;
            break;
        }

        $payment = $this->mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "10.00"
            ],
            "metadata" => [
                "order_id" => $order['id']
            ],
            "description" => "Bestelling {$order['order_nr']}",
            "redirectUrl" => route('paymentDone', $order['id']),
            //"webhookUrl"  => 'http://7b4f1bdd.ngrok.io/checkout/webhook',
            "webhookUrl"  => route('checkout.webhook'),
            "method"      => $method,
        ]);

        return redirect()->to($payment->getCheckoutUrl(), 303);
    }

    public function sendEmail(WebshopOrder $webshopOrder)
    {
        Mail::to($webshopOrder->user->email)->cc('info@vanspelden.nl')->send(new Order($webshopOrder));
    }

    public function sendInvoice(WebshopOrder $webshopOrder)
    {
        Mail::to($webshopOrder->user->email)->send(new OrderInvoice($webshopOrder));
    }

    public function webhook(Request $request)
    {
        $payment = $this->mollie->payments->get($request->get('id'));
        $orderId = $payment->metadata->order_id;

        $webshopOrder = WebshopOrder::find($orderId);
        $webshopOrder->status = $payment->status;
        $webshopOrder->save();

        if ($payment->status == 'paid') {
            self::sendEmail($webshopOrder);
            self::sendInvoice($webshopOrder);
        }
    }

    public function paymentDone($order_id)
    {
        $order = WebshopOrder::find($order_id);

        if ($order->status == 'paid') {
            session()->remove('order');
            session()->remove('cart');
        }

        return redirect()->route('order.done', $order_id);
    }
}
