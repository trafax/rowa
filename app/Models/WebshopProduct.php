<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebshopProduct extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;

    public $fillable = [
        'parent_id', 'title', 'brand', 'type', 'price', 'tax', 'sku', 'description', 'slug'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\WebshopCategory', 'id', 'parent_id');
    }

    public function assets()
    {
        return $this->hasMany('App\Models\Asset', 'parent_id', 'id')->orderBy('sort');
    }
}
