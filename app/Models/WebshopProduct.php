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
        'parent_id', 'title', 'brand', 'type', 'price', 'tax', 'sku', 'description', 'slug', 'needs_image'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\WebshopCategory', 'id', 'parent_id');
    }

    public function assets()
    {
        return $this->hasMany('App\Models\Asset', 'parent_id', 'id')->orderBy('sort');
    }

    public function filters()
    {
        return $this->belongsToMany('App\Models\WebshopFilter')->orderBy('fixed_price')->withPivot('id', 'sort', 'slug', 'value', 'fixed_price', 'added_price')->orderBy('pivot_sort');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
