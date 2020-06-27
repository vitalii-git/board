<?php

namespace App\Http\Controllers;

use App\Http\Requests\Label\StoreRequest;
use App\Http\Requests\Label\UpdateRequest;
use App\Http\Resources\Label\IndexResource;
use App\Http\Resources\Label\ShowResource;
use App\Http\Resources\Label\StoreResource;
use App\Http\Resources\Label\UpdateResource;
use App\Interfaces\Repositories\LabelRepositoryInterface;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    private $labelRepository;

    public function __construct(LabelRepositoryInterface $labelRepository)
    {
        $this->labelRepository = $labelRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return IndexResource
     */
    public function index()
    {
        $labels = $this->labelRepository->index();

        return new IndexResource($labels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return StoreResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only(['name']);
        $label = $this->labelRepository->store($data);

        return new StoreResource($label);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ShowResource
     */
    public function show($id)
    {
        $label = $this->labelRepository->show($id);

        return new ShowResource($label);
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
        $label = $this->labelRepository->update($data, $id);

        return new UpdateResource($label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->labelRepository->destroy($id);

        return response()->json(['message' => 'Label was deleted'], 200);
    }
}
