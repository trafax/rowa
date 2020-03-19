<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use Uuids;

    public $incrementing = false;

    public $fillable = [
        'user_id', 'title', 'qty', 'collie', 'image', 'email_no_stock'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
