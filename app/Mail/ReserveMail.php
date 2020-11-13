<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReserveMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_reservation)
    {
        $this->user_reservation = $user_reservation;
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
            ->subject('**TEST**予約受付のご連絡[ShareCOOK]')
            ->view('mail.reserve_mail')
            ->text('mail.reserve_mail_plain')
            ->with([
                'schedule_info' => $schedule_info,
                'user_reservation' => $this->user_reservation,
                ]);
    }
}
