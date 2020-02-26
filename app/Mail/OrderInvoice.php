<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\WebshopOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade as PDF;

class OrderInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $html;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailTemplate = EmailTemplate::find('e5c5f8b0-4e66-11ea-a46e-bb80697b8d6f');
        $order = WebshopOrder::find($this->order['id']);

        //$bestelling = view('emailtemplates.order')->with('order', $order)->render();

        $content = $emailTemplate->content;
        $content = str_replace('{klant}', ($order->user->firstname . ' ' . $order->user->preposition . ' ' . $order->user->lastname), $content);

        $emailTemplate->content = $content;

        $this->html = $emailTemplate->content;

        // Invoice PDF
        $html = view('webshop.orders.admin.order_pdf', ['order' => $order])->render();
        $pdf = PDF::loadHTML($html);
        $pdf = $pdf->stream();

        return $this->from('noreply@rowa.nl')->subject('Factuur '. $order->order_nr)->view('emailtemplates.email')->with('emailTemplate', $emailTemplate)->attachData($pdf, 'Factuur '.$order->order_nr.'.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
