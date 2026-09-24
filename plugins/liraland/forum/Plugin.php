<?php namespace Liraland\Forum;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['Winter.User'];

    public function pluginDetails()
    {
        return [
            'name'        => 'Liraland Forum',
            'description' => 'Корпоративний інженерний форум Liraland з підтримкою міграції з 1С-Бітрікс',
            'author'      => 'Liraland Group',
            'icon'        => 'icon-comments'
        ];
    }
}
