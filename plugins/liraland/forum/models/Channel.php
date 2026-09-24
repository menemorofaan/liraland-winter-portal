<?php namespace Liraland\Forum\Models;

use Model;

class Channel extends Model
{
    public $table = 'liraland_forum_channels';
    protected $guarded = ['*'];
    public $belongsTo = [
        'category' => ['Liraland\Forum\Models\Category', 'key' => 'category_id']
    ];
    public $hasMany = [
        'topics' => ['Liraland\Forum\Models\Topic', 'key' => 'channel_id', 'order' => 'updated_at desc']
    ];
}
