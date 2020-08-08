<?php

namespace App\Events;

use App\user;
use App\comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that sent the message
     *
    //  * @var User
     */
    public $user;

    /**
     * Message details
     *
    // * @var Message
     */
    public $comment;

    /**
     * Create a new event instance.
     *
    // * @return void
     */
    public function __construct(user $user, comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
    // * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
}
