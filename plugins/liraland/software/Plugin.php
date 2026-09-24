<?php

namespace Liraland\Software;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
use System\Classes\PluginBase;

/**
 * Software Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'liraland.software::lang.plugin.name',
            'description' => 'liraland.software::lang.plugin.description',
            'author'      => 'Liraland',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return []; // Remove this line to activate

        return [
            \Liraland\Software\Components\MyComponent::class => 'myComponent',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            // Права на дистрибутивы
            'liraland.software.distributives.manage' => [
                'tab'   => 'Liraland: Дистрибутиви',
                'label' => 'Повний доступ до дистрибутивів (створення, файли, видалення)',
            ],

            // Права на лицензии
            'liraland.software.licenses.manage' => [
                'tab'   => 'Liraland: Ліцензії',
                'label' => 'Управління ліцензіями (генерація ключів, донгли)',
            ],

            // Права на тикеты (разделим на просмотр и удаление!)
            'liraland.software.tickets.access' => [
                'tab'   => 'Liraland: Техпідтримка',
                'label' => 'Перегляд та обробка тікетів',
            ],
            'liraland.software.tickets.delete' => [
                'tab'   => 'Liraland: Техпідтримка',
                'label' => 'Видалення тікетів з бази',
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return [
            'software' => [
                'label'       => 'Liraland Софт',
                'url'         => \Backend::url('liraland/software/tickets'),
                'icon'        => 'icon-cubes',
                'permissions' => ['liraland.software.*'],
                'order'       => 500,
                'sideMenu'    => [
                    'distributives' => [
                        'label'       => 'Дистрибутиви',
                        'icon'        => 'icon-download',
                        'url'         => \Backend::url('liraland/software/distributives'),
                        'permissions' => ['liraland.software.distributives.manage'], // Требуем право!
                    ],
                    'licenses' => [
                        'label'       => 'Ліцензії (CodeMeter/Хмара)',
                        'icon'        => 'icon-key',
                        'url'         => \Backend::url('liraland/software/licenses'),
                        'permissions' => ['liraland.software.licenses.manage'],      // Требуем право!
                    ],
                    'tickets' => [
                        'label'       => 'Тікети підтримки',
                        'icon'        => 'icon-ticket',
                        'url'         => \Backend::url('liraland/software/tickets'),
                        'permissions' => ['liraland.software.tickets.access'],       // Требуем право!
                    ],
                ]
            ],
        ];
    }
}
