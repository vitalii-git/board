<?php


namespace App\Repositories;


use App\Events\TaskEvent;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Log;
use App\Task;
use App\Traits\TaskEventTrait;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{
    use TaskEventTrait;

    /**
     * @param array $data
     * @return mixed
     */
    public function index(array $data)
    {
        $tasks = Task::where('id', '<>', 0);

        if (isset($data['status']) && $data['status']) {
            $tasks->filterByStatus($data['status']);
        }
        if (isset($data['labels']) && $data['labels']) {
            $data['labels'] = is_array($data['labels']) ? $data['labels'] : explode(',', $data['labels']);
            $tasks->filterByLabels($data['labels']);
        }

        return $tasks->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $task = Task::create($data);
        $task->labels()->sync($data['labels']);
        $task->save();
        event(new TaskEvent($task, Log::ACTION_STORE));

        return $task;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Task::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, int $id)
    {
        $task = Task::find($id);
        if (Auth::user()->can('update', $task)) {
            $task->labels()->sync($data['labels']);
            $task->update($data);
            $this->logTaskEvents($task);

            return $task;
        }
        throw new \Exception('Access denied');
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $task = Task::find($id);
        if (Auth::user()->can('delete', $task)) {
            event(new TaskEvent($task, Log::ACTION_DESTROY));
            return $task->delete();
        }
        throw new \Exception('Access denied');
    }

}
