<?php

namespace App\Listeners;

use App\Log;

class LogListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Log::create([
            'task_id' => $event->task->id,
            'user_id' => $event->task->user_id,
            'action_name' => $event->action,
        ]);
    }
}
