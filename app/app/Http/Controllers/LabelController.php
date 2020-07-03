<?php

namespace App\Http\Controllers;

use App\Http\Requests\Label\StoreRequest;
use App\Http\Requests\Label\UpdateRequest;
use App\Http\Resources\Label\LabelCollection;
use App\Http\Resources\Label\LabelResource;
use App\Label;
use App\Services\LabelService;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    private $labelService;

    public function __construct(LabelService $labelService)
    {
        $this->labelService = $labelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return LabelCollection
     */
    public function index()
    {
        $labels = $this->labelService->index();

        return new LabelCollection($labels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return LabelResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $label = $this->labelService->store($data);

        return new LabelResource($label);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Label $label
     * @return LabelResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Label $label)
    {
        $this->authorize('view', $label);
        $label = $this->labelService->show($label->id);

        return new LabelResource($label);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Label $label
     * @return LabelResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Label $label)
    {
        $this->authorize('update', $label);
        $data = $request->validated();
        $label = $this->labelService->update($data, $label->id);

        return new LabelResource($label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Label $label
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Label $label)
    {
        $this->authorize('delete', $label);
        $this->labelService->destroy($label->id);

        return response()->json(['message' => 'Label deleted']);
    }
}
