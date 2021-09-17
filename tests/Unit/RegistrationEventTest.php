<?php

namespace Tests\Unit;

use App\Events\RegistrationEvent;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendEmailNotification;
use Illuminate\Foundation\Testing\WithFaker;


class RegistrationEventTest extends TestCase
{
    use WithFaker;
   
    public function testRegistrationEvent()
    {
        Event::fake();
       
        Event::assertListening(
            RegistrationEvent::class,
            SendEmailNotification::class);
    }
}
