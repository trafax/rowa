<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Cart
{
    public static function add()
    {
        list($id, $title, $qty, $price, $options) = func_get_args();

        session()->push('cart', [
            'id' => $id,
            'title' => $title,
            'qty' => $qty,
            'price' => $price,
            'options' => $options
        ]);

        // dump(Session::get('cart'));
    }

    public static function truncate()
    {
        session()->forget('cart');
    }
}

