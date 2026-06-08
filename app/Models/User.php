<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\verifyEmail as NotificationsVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmail;
use Override;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail //la interfaz MustVerifyEmail indica que el modelo User requiere verificación de correo electrónico
{

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);//envía la notificación de verificación de correo electrónico al usuario registrado, el método notify() se encarga de enviar la notificación utilizando el canal de correo electrónico definido en la clase VerifyEmail
    }



    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
