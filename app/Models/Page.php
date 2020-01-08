<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use Uuids;
    use SoftDeletes;

    public $incrementing = false;

    public $fillable = [
        'parent_id', 'title', 'slug', 'seo', 'sort'
    ];

    public $casts = [
        'seo' => 'array'
    ];

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id');
    }
}
