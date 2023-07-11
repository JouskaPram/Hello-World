<?php

namespace App\Events;

use App\Models\Pesan;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class msgsend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 public $pesan;
 public $user;

    public function __construct($pesan,$user)
    {
        $this->pesan = $pesan;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return ('chatting');
    }
      public function broadcastWith()
  {
      return ["pesan"=>$this->pesan];
  }
}
