<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class FormSubscription extends Model
{
    use Uuids;

    public $incrementing = false;

    public $fillable = [
        'form_id', 'form_data'
    ];

    public $casts = [
        'form_data' => 'array'
    ];
}
