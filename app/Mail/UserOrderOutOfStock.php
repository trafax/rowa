<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use App\Models\WebshopOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrderOutOfStock extends Mailable
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
        $emailTemplate = EmailTemplate::find('dfa28cc0-5881-11ea-bc23-0fd7a2bc31af');

        $bestelling = view('emailtemplates.userorderoutofstock')->with('order', $this->order)->render();

        $content = $emailTemplate->content;
        $content = str_replace('{klant}', ($this->order['user']->firstname . ' ' . $this->order['user']->preposition . ' ' . $this->order['user']->lastname), $content);
        $content = str_replace('{bedrijf}', $this->order['user']->company_name, $content);
        $content = str_replace('{producten}', $bestelling, $content);

        $emailTemplate->content = $content;

        $this->html = $emailTemplate->content;

        return $this->from('noreply@rowa.nl')->subject($emailTemplate->title . ' - '. $this->order['user']->company_name)->view('emailtemplates.email')->with('emailTemplate', $emailTemplate);
    }
}
