<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(//genera una URL temporalmente firmada para la verificación de correo electrónico
            'verification.verify',
            now()->addMinutes(60),//minutos que dura el enlace de verificación
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );


        return (new MailMessage)
            ->subject('Confirma tu cuenta en CashTrackr') //asunto del correo
            ->greeting('Hola ' . $notifiable->name . ',') //saludo personalizado con el nombre del usuario
            ->line('Gracias por registrarte en CashTrackr. Para completar tu registro, por favor haz clic en el siguiente enlace para verificar tu dirección de correo electrónico:') //mensaje principal del correo
            ->action('Confirmar Correo', $verificationUrl) //botón con el enlace de verificación
            ->line('Gracias por usar nuestra aplicación!'); //mensaje de despedida
    }

  
}
