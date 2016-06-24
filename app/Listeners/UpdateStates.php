<?php

namespace App\Listeners;

use App\Events\UpdateStats;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateStates
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
     * @param  UpdateStats  $event
     * @return void
     */
    public function handle(UpdateStats $event)
    {
        //
    }
}
