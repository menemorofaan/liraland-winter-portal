<?php namespace Liraland\Software\Models;

use Model;
use Str;

class License extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    public $table = 'liraland_software_licenses';

    protected $guarded = [];

    protected $fillable = [
        'license_key',
        'software_name',
        'client_name',
        'client_email',
        'user_id',
        'type',
        'dongle_id',
        'expires_at',
        'status',
        'notes',
    ];

    protected $dates = ['expires_at'];

    // Прямая связь с пользователями сайта (Winter.User)
    public $belongsTo = [
        'user' => [\Winter\User\Models\User::class, 'key' => 'user_id']
    ];

    public $rules = [
        'software_name' => 'required',
        'type'          => 'required',
    ];

    public function beforeSave()
    {
        // Если выбрали пользователя из базы — автоматически подтягиваем его данные
        if ($this->user_id && $this->user) {
            $this->client_email = $this->user->email;
            if (empty($this->client_name)) {
                $this->client_name = trim($this->user->name . ' ' . ($this->user->surname ?? ''));
            }
        }
    }

    public function beforeCreate()
    {
        if (empty($this->license_key)) {
            $this->license_key = 'LIC-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
        }
    }
}
