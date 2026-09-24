<?php namespace Liraland\Software\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

class Tickets extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Liraland.Software', 'software', 'tickets');
    }
	
	protected $requiredPermissions = [
        'liraland.software.tickets.access',
    ];
}