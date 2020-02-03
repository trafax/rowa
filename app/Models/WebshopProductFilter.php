<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class WebshopProductFilter extends Model
{
    use Uuids;

    public $incrementing = false;
    public $table = 'webshop_filter_webshop_product';

    public $fillable = [
        'value', 'slug', 'fixed_price', 'added_price', 'sort'
    ];

    public function filter()
    {
        return $this->hasOne('App\Models\WebshopFilter', 'id', 'webshop_filter_id');
    }

    public function scopeSlugs($query, $slugs)
    {
        return $query->whereIn('slug', $slugs)->groupBy('webshop_product_id');
    }
}
