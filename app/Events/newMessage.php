<?php

namespace App\Events;

use App\Chat;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class newMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;
    /**
     * @var Chat
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param Chat $message
     */
    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['new-message'];
    }
}
