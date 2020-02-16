<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class WebshopOrderRule extends Model
{
    use Uuids;

    public $incrementing = false;

    public $fillable = [
        'order_id', 'user_id', 'product_id', 'qty', 'price', 'options'
    ];

    public $casts = [
        'options' => 'array'
    ];

    public function product()
    {
        return $this->hasOne(WebshopProduct::class, 'id', 'product_id');
    }
}
