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
        'parent_id', 'webshop_category_id', 'title', 'content', 'template', 'hyperlink', 'slug', 'seo', 'navigation_image', 'sort', 'show_on_home', 'show_in_menu'
    ];

    public $casts = [
        'seo' => 'array'
    ];

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')->orderBy('sort');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'parent_id', 'id')->orderBy('sort');
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'parent_id', 'id')->orderBy('sort');
    }
}
