<?php

namespace App\Listeners;

use App\Events\SendWelcomeEmailEvent;
use App\Mail\SendWelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendWelcomeEmailEvent  $event
     * @return void
     */
    public function handle(SendWelcomeEmailEvent $event)
    {
        Mail::to($event->email)->send(new SendWelcomeMail());
    }
}
