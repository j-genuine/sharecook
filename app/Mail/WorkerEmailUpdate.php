<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorkerEmailUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($temp_worker)
    {
        $this->temp_worker = $temp_worker;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->temp_worker->email)
            ->subject('メールアドレス変更のお手続き[ShareCOOK]')
            ->text('mail.worker_email_update_mail')
            ->with([
                'temp_worker' => $this->temp_worker,
                ]);
    }
}
