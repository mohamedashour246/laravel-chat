<?php

namespace App\Events;

use App\Models\Admin;
use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendAdminMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
//        return [
//            new PrivateChannel('channel-name'),
//        ];

        return [
            new Channel('admin-message')
            ];
    }

    public function broadcastWith()
    {
        $admin = Admin::find($this->message->sender_id);

        if ($admin) {
            return [
                'message' => $this->message->message,
                'receiver_id' => $this->message->receiver_id,
                'sender_id' => $this->message->sender_id,
                'admin' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'image' => asset('storage/' . $admin->picture),
                ],
                'created_at' => $this->message->created_at,
            ];
        }
        else {
            return [
                'message' => $this->message->message,
                'receiver_id' => $this->message->receiver_id,
                'sender_id' => $this->message->sender_id,
                'admin' => [
                    'id' => null,
                    'name' => 'Unknown Admin',
                    'image' => asset('storage/default-avatar.png'),
                ],
                'created_at' => $this->message->created_at,
            ];
        }
    }

    public function broadcastAs()
    {
        return 'admin-message';
    }
}
