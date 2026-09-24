<?php

namespace Liraland\Software\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Distributives Backend Controller
 */
class Distributives extends Controller
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
     * Закомментировано на время разработки
     */
    // protected $requiredPermissions = [
    //     'liraland.software.distributives.manage_all',
    // ];

    public function __construct()
    {
        parent::__construct();

        // Подсвечиваем активным пункт "Дистрибутиви" в меню
        BackendMenu::setContext('Liraland.Software', 'software', 'distributives');
    }
	
	protected $requiredPermissions = [
        'liraland.software.distributives.manage',
    ];
}