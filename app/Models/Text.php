<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Text extends Model
{
    use Uuids;

    public $table = 'text';

    public $incrementing = false;

    public $fillable = [
        'parent_id', 'content'
    ];
}
