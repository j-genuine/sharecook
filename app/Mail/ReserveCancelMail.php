<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReserveCancelMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_reservation, $cancel_reason)
    {
        $this->user_reservation = $user_reservation;
        $this->cancel_reason = $cancel_reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 成型されたスケジュール情報を取得
		$schedule_info = $this->user_reservation->workerSchedule()->first()->scheduleInfo();
        
        return $this->to($schedule_info["email"])
            ->subject('**TEST**予約キャンセルのご連絡[ShareCOOK]')
            ->view('mail.reserve_cancel_mail')
            ->text('mail.reserve_cancel_mail_plain')
            ->with([
                'schedule_info' => $schedule_info,
                'user_reservation' => $this->user_reservation,
                'cancel_reason' => $this->cancel_reason,
                ]);
    }
}
