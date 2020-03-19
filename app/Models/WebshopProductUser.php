<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebshopProductUser extends Model
{
    public $timestamps = false;
    public $incrementing = false;

    public $fillable = [
        'product_id', 'user_id'
    ];
}
