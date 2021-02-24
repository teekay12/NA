<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Profile;

class CreateUserProfile
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
     * @param  UserEvent  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        $cx = new Profile;

        $cx->name = $event->request->name;
        $cx->email = $event->request->email;
        $cx->mobile = $event->request->mobile;
        $cx->country = $event->request->country;

        $event->user->profile()->save($cx);
    }
}
