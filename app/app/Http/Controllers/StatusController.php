<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status\StoreRequest;
use App\Http\Requests\Status\UpdateRequest;
use App\Http\Resources\Status\StatusCollection;
use App\Http\Resources\Status\StatusResource;
use App\Services\StatusService;

class StatusController extends Controller
{
    private $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return StatusCollection
     */
    public function index()
    {
        $statuses = $this->statusService->index();

        return new StatusCollection($statuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return StatusResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $status = $this->statusService->store($data);

        return new StatusResource($status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return StatusResource
     */
    public function show($id)
    {
        $status = $this->statusService->show($id);

        return new StatusResource($status);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return StatusResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $status = $this->statusService->update($data, $id);

        return new StatusResource($status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->statusService->destroy($id);

        return response()->json(['message' => 'Status was deleted'], 200);
    }
}
