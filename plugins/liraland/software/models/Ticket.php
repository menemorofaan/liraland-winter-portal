<?php namespace Liraland\Software\Models;

use Model;
use Str;

class Ticket extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'liraland_software_tickets';

    protected $guarded = ['*'];

    protected $fillable = [
        'ticket_number',
        'subject',
        'client_name',
        'client_email',
        'product',
        'priority',
        'status',
        'assigned_to_id',
        'message',
        'internal_notes',
    ];

    // Связываем заявку с пользователем админки (инженером поддержки)
    public $belongsTo = [
        'assigned_to' => [\Backend\Models\User::class, 'key' => 'assigned_to_id']
    ];

    public $rules = [
        'subject'      => 'required',
        'client_name'  => 'required',
        'client_email' => 'required|email',
        'product'      => 'required',
        'message'      => 'required',
    ];

    public function beforeCreate()
    {
        if (empty($this->ticket_number)) {
            // Генерация номера вида TCK-84920
            $this->ticket_number = 'TCK-' . rand(10000, 99999);
        }
    }
}