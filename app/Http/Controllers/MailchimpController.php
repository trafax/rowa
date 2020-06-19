<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Newsletter;

class MailchimpController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
        ]);

        if (Newsletter::isSubscribed($request->get('email')) == false) {
            Newsletter::subscribe($request->get('email'), ['FNAME' => $request->get('fname'), 'LNAME' => $request->get('lname')]);
            Session::flash('message', 'U bent succesvol ingeschreven.');
        } else {
            Session::flash('message', 'U bent al ingeschreven.');
        }

        return redirect()->to(url()->previous() . '#mailchimp');
    }
}
