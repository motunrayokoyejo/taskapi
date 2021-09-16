<?php

namespace App\Listeners;

use App\Events\RegistrationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationMail;

class SendEmailNotification implements ShouldQueue
{
    use InteractsWithQueue;
  
    /**
     * Handle the event.
     *
     * @param  RegistrationEvent $event
     * @return void
     */
    public function handle(RegistrationEvent $event)
    {
        Mail::to($event->user)
            ->send(new UserRegistrationMail($event->user));
    }
}
