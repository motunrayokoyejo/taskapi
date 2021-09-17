<?php

namespace Tests\Unit;
use App\Events\RegistrationEvent;
use App\Listeners\SendEmailNotification;
use App\Mail\UserRegistrationMail;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;


class UserRegistrationMailTest extends TestCase
{
    public function testMailSent(){

        Mail::fake();
        $user = User::factory()->create();
        $event = new RegistrationEvent($user);
        $listener = new SendEmailNotification();
        $listener->handle($event);
        Mail::assertQueued(UserRegistrationMail::class);
    }
    
}