<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebshopOrder extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;

    public $fillable = [
        'order_nr', 'status', 'paymentMethod', 'price_sub_total', 'price_shipping', 'price_total', 'invoice_address', 'delivery_address'
    ];

    public $casts = [
        'invoice_address' => 'array',
        'delivery_address' => 'array'
    ];

    public function rules()
    {
        return $this->hasMany(WebshopOrderRule::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
