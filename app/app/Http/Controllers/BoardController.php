<?php

namespace App\Http\Controllers;

use App\Http\Requests\Board\StoreRequest;
use App\Http\Requests\Board\UpdateRequest;
use App\Http\Resources\Board\IndexResource;
use App\Http\Resources\Board\ShowResource;
use App\Http\Resources\Board\StoreResource;
use App\Http\Resources\Board\UpdateResource;
use App\Interfaces\Repositories\BoardRepositoryInterface;
use Illuminate\Http\JsonResponse;

class BoardController extends Controller
{
    private $boardRepository;

    public function __construct(BoardRepositoryInterface $boardRepository)
    {
        $this->boardRepository = $boardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return IndexResource
     */
    public function index()
    {
        $boards = $this->boardRepository->index();

        return new IndexResource($boards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return StoreResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only('name');
        $board = $this->boardRepository->store($data);

        return new StoreResource($board);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ShowResource
     */
    public function show($id)
    {
        $board = $this->boardRepository->show($id);

        return new ShowResource($board);
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
        $data = $request->only('name');
        $board = $this->boardRepository->update($data, $id);

        return new UpdateResource($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $this->boardRepository->destroy($id);

        return response()->json(['message' => 'Board was deleted'], 200);
    }
}
