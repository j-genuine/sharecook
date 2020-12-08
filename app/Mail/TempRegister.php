<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TempRegister extends Mailable
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
            ->subject('シェフ会員本登録のお手続き[ShareCOOK]')
            ->text('mail.temp_worker_register_mail')
            ->with([
                'temp_worker' => $this->temp_worker,
                ]);
    }
}
