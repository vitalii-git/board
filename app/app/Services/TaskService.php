<?php


namespace App\Services;


use App\Events\TaskEvent;
use App\Log;
use App\Task;
use App\Traits\TaskEventTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskService
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

        return $tasks->own(Auth::user()->id)->paginate();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $task = Task::create($data);
            $task->labels()->sync($data['labels']);
            $task->save();
            DB::commit();

            event(new TaskEvent($task, Log::ACTION_STORE));

            return $task;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Task::own(Auth::user()->id)->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::findOrFail($id);
            $task->labels()->sync($data['labels']);
            $task->update($data);
            DB::commit();

            $this->logTaskEvents();

            return $task;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $task = Task::findOrFail($id);
            event(new TaskEvent($task, Log::ACTION_DESTROY));
            DB::commit();

            return $task->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }
}
