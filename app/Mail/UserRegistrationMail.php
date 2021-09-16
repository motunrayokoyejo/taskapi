<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserRegistrationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user =$user;
    }

    
    public function build()
    {
        $subject = 'Hello' .$this->user->name . ', 
        your registration is successful!';

        return $this->subject($subject)
                    ->view('mail.register');
    }
}
