<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class msgsend implements ShouldBroadcast
{
    public $count;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function broadcastOn()
    {
        return new Channel('counter-channel');
    }

    public function broadcastAs()
    {
        return 'counter-updated';
    }
}

