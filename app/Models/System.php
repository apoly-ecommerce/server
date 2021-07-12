<?php

namespace App\Models;

use App\Common\Imageable;
use App\Common\Addressable;
use App\Common\SystemUser;
use Illuminate\Notifications\Notifiable;

class System extends BaseModel
{
    use SystemUser, Notifiable, Addressable, Imageable;
    /**
     * The app version
     *
     * @var string
     */
    const VERSION = '1.1.1';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'systems';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'install_version',
        'maintenance_mode',
        'name',
        'slogan',
        'legal_name',
        'email',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->support_email ? $this->support_email : $this->email;
    }

    /**
     * Check if the system is down or live.
     *
     * @return bool
     */
    public function isDown()
    {
        return $this->maintenance_mode;
    }
}