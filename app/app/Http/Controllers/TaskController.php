<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\IndexRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\Task\TaskCollection;
use App\Http\Resources\Task\TaskResource;
use App\Services\TaskService;
use App\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return TaskCollection
     */
    public function index(IndexRequest $request)
    {
        $data = $request->validated();
        $tasks = $this->taskService->index($data);

        return new TaskCollection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return TaskResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $task = $this->taskService->store($data);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Task $task
     * @return TaskResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Task $task)
    {
        $this->authorize('view', $task);
        $task = $this->taskService->show($task->id);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Task $task
     * @return TaskResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $data = $request->validated();
        $task = $this->taskService->update($data, $task->id);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Task $task
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('delete', $task);
        $this->taskService->destroy($task->id);

        return response()->json(['message' => 'Task was deleted']);
    }
}
