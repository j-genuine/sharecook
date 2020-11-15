<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class WorkerPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            /*
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(config('url').route('workers.password.reset', $this->token, false)))
            ->line('If you did not request a password reset, no further action is required.');
            */
            ->subject('パスワード変更URLのお知らせ[ShareCOOK]')
            ->line('サイトでのパスワード変更リクエストを受付しました。下記URLにアクセスし、変更を完了してください。')
            ->action('パスワード変更URL', url(config('url').route('workers.password.reset', $this->token, false)))
            ->line('※変更中止する場合、これ以上の操作は不要です。');
    }
}