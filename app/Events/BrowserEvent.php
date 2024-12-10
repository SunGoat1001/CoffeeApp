<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BrowserEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public const DISPLAY_OFFCANVAS = 'display-offcanvas';

    public const CLOSE_OFFCANVAS = 'close-offcanvas';

    public const LANGUAGE_CHANGED = 'language-changed';

    public const THEME_CHANGED = 'theme-changed';

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
