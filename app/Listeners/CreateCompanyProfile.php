<?php

namespace App\Listeners;

use App\Events\CompanyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Company;

class CreateCompanyProfile
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
     * @param  Company  $event
     * @return void
     */
    public function handle(CompanyEvent $event)
    {
        $cx = new Company;

        $cx->name = $event->request->name;
        $cx->email = $event->request->email;
        $cx->location = $event->request->location;
        
        $event->user->company()->save($cx);
    }
}
