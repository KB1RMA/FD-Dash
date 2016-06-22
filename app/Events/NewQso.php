<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Qso;

class NewQso extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $qso;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Qso $qso)
    {
        $this->qso = $qso;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['qso'];
    }
}