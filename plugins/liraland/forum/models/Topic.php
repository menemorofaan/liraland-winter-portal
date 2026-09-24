<?php namespace Liraland\Forum\Models;

use Model;

class Topic extends Model
{
    public $table = 'liraland_forum_topics';
    protected $guarded = []; // Разрешаем заполнение полей

    public $belongsTo = [
        'channel' => ['Liraland\Forum\Models\Channel'],
        'user'    => ['Winter\User\Models\User']
    ];

    public $hasMany = [
        'posts' => ['Liraland\Forum\Models\Post', 'order' => 'created_at asc']
    ];
}
