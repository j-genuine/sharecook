<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class UserPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('パスワード変更URLのお知らせ[ShareCOOK]')
            ->line('サイトでのパスワード変更リクエストを受付しました。下記URLにアクセスし、変更を完了してください。')
            ->action('パスワード変更URL', url(config('url').route('password.reset', $this->token, false)))
            ->line('※変更中止する場合、これ以上の操作は不要です。');
    }
}