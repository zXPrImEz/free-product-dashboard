<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserCreated
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
     * @param  \App\Events\UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        $role = config('roles.models.role')::where('name', '=', 'User')->first();
        $event->user->attachRole($role);
    }
}
