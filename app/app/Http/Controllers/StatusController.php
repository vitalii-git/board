<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Http\Resources\Status\IndexResource;
use App\Http\Resources\Status\StoreResource;
use App\Http\Resources\Status\UpdateResource;
use App\Http\Resources\Task\ShowResource;
use App\Interfaces\Repositories\StatusRepositoryInterface;

class StatusController extends Controller
{
    private $statusRepository;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return IndexResource
     */
    public function index()
    {
        $statuses = $this->statusRepository->index();

        return new IndexResource($statuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return StoreResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only(['name']);
        $status = $this->statusRepository->store($data);

        return new StoreResource($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ShowResource
     */
    public function show($id)
    {
        $status = $this->statusRepository->show($id);

        return new ShowResource($status);
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
        $data = $request->only(['name']);
        $status = $this->statusRepository->update($data, $id);

        return new UpdateResource($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->statusRepository->destroy($id);

        return response()->json(['message' => 'Status was deleted'], 200);
    }
}
