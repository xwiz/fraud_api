<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Api\Models\User;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;


    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->from('info@secapay.com')->view('verifymail')->with(['name'=> $this->user->last_name, 'confirmation_code' => $this->user->confirmation_code]);
    }
}
