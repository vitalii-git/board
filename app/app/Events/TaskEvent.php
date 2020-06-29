<?php

namespace App\Events;

use App\Task;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $action;

    /**
     * Create a new event instance.
     *
     * @param Task $task
     * @param $action
     */
    public function __construct(Task $task, $action)
    {
        $this->task = $task;
        $this->action = $action;
    }
}
