<?php

namespace Liraland\Software\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Licenses Backend Controller
 */
class Licenses extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var array Permissions required to view this page.
     * Закомментируем на время тестов, чтобы не ловить 403 Forbidden
     */
    // protected $requiredPermissions = [
    //     'liraland.software.licenses.manage_all',
    // ];

    public function __construct()
    {
        parent::__construct();

        // 1-й аргумент: Плагин (Liraland.Software)
        // 2-й аргумент: Главная вкладка в верхнем меню (software)
        // 3-й аргумент: Пункт в боковом меню слева (licenses)
        BackendMenu::setContext('Liraland.Software', 'software', 'licenses');
    }
	
	protected $requiredPermissions = [
        'liraland.software.licenses.manage',
    ];
}