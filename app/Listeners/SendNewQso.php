<?php

namespace App\Listeners;

use App\Events\NewQso;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewQso
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
     * @param  NewQso  $event
     * @return void
     */
    public function handle(NewQso $event)
    {
        //
    }
}
