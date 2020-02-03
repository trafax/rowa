<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebshopFilter extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;

    public $fillable = [
        'title', 'slug', 'sort', 'sort_by', 'selectable'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\WebshopProduct');
    }
}
