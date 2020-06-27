<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\Board\ShowResource;
use App\Http\Resources\Board\StoreResource;
use App\Http\Resources\Task\IndexResource;
use App\Http\Resources\Task\UpdateResource;
use App\Interfaces\Repositories\TaskRepositoryInterface;

class TaskController extends Controller
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return IndexResource
     */
    public function index()
    {
        $tasks = $this->taskRepository->index();

        return new IndexResource($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return StoreResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only(['title', 'description', 'board_id']);
        $task = $this->taskRepository->store($data);

        return new StoreResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ShowResource
     */
    public function show($id)
    {
        $task = $this->taskRepository->show($id);

        return new ShowResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return UpdateResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->only(['title', 'description', 'board_id']);
        $task = $this->taskRepository->update($data, $id);

        return new UpdateResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->taskRepository->destroy($id);

        return response()->json(['message' => 'Task was deleted'], 200);
    }
}
