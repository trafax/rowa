<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\WebshopOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $html;
    public $order;

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
        $emailTemplate = EmailTemplate::find('5ce33c80-587f-11ea-83a6-3b4f47e63105');
        //$order = WebshopOrder::find($this->order['id']);

        $bestelling = view('emailtemplates.userorder')->with('order', $this->order)->render();

        $content = $emailTemplate->content;
        $content = str_replace('{klant}', ($this->order['user']->firstname . ' ' . $this->order['user']->preposition . ' ' . $this->order['user']->lastname), $content);
        $content = str_replace('{bestelling}', $bestelling, $content);

        $emailTemplate->content = $content;

        $this->html = $emailTemplate->content;

        return $this->from('noreply@rowa.nl')->subject('Bestelling '. $this->order['user']->company_name)->view('emailtemplates.email')->with('emailTemplate', $emailTemplate);
    }
}
