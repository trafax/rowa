<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\WebshopOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
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
        $emailTemplate = EmailTemplate::find('a1b6c090-4e62-11ea-99f0-ed6b08141129');
        $order = WebshopOrder::find($this->order['id']);

        $bestelling = view('emailtemplates.order')->with('order', $order)->render();

        $content = $emailTemplate->content;
        $content = str_replace('{klant}', ($order->user->firstname . ' ' . $order->user->preposition . ' ' . $order->user->lastname), $content);
        $content = str_replace('{bestelling}', $bestelling, $content);

        $emailTemplate->content = $content;

        $this->html = $emailTemplate->content;

        return $this->from('noreply@rowa.nl')->view('emailtemplates.email')->with('emailTemplate', $emailTemplate);
    }
}
