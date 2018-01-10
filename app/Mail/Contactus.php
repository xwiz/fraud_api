<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Api\Models\Contact;

class Contactus extends Mailable
{
    use Queueable, SerializesModels;


    protected $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        //
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@fraudkoboko.com', 'Fraud Koboko')->view('mail')->with(['name'=> $this->contact->name, 'email' => $this->contact->email, 'msg' => $this->contact->message]);
    }
}
