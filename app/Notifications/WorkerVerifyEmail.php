<?php

namespace App\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WorkerVerifyEmail extends Notification
{
    //use Queueable;
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(__('Verify Your Email Address'))
            ->line(__('Please click the link below to verify your email address.'))
            ->action(__('Verify Email Address'), $this->verificationUrl($notifiable))
            ->line(__('If you did not create an account, no further action is required.'));
    }

    protected function verificationUrl($notifiable)
    {
        //dd(['id' => $notifiable->getKey()]);
        return URL::temporarySignedRoute(
            'workers.verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey(), 'hash' => 'hash']
        );
    }
 
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
