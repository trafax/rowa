<?php

namespace App\Libraries;

class Cart
{
    public static function add()
    {
        list($id, $title, $qty, $price, $options) = func_get_args();
    }
}

