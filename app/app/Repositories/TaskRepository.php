<?php


namespace App\Repositories;


use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Task;

class TaskRepository implements TaskRepositoryInterface
{

    /**
     * @return mixed
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Task::create($data);
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
     */
    public function update(array $data, int $id)
    {
        $task = Task::find($id);

        return tap($task)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return Task::where('id', $id)->delete();
    }

}
