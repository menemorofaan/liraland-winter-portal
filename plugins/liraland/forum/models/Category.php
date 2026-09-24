<?php namespace Liraland\Forum\Models;

use Model;

class Category extends Model
{
    public $table = 'liraland_forum_categories';
    protected $guarded = ['*'];
    public $hasMany = [
        'channels' => ['Liraland\Forum\Models\Channel', 'key' => 'category_id', 'order' => 'sort_order asc']
    ];
}
