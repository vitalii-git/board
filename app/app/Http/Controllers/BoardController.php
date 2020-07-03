<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\Board\StoreRequest;
use App\Http\Requests\Board\UpdateRequest;
use App\Http\Resources\Board\BoardCollection;
use App\Http\Resources\Board\BoardResource;
use App\Services\BoardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    private $boardService;

    public function __construct(BoardService $boardService)
    {
        $this->boardService = $boardService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return BoardCollection
     */
    public function index()
    {
        $boards = $this->boardService->index();

        return new BoardCollection($boards);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return BoardResource
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $board = $this->boardService->store($data);

        return new BoardResource($board);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Board $board
     * @return BoardResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Board $board)
    {
        $this->authorize('view', $board);
        $board = $this->boardService->show($board->id);

        return new BoardResource($board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Board $board
     * @return BoardResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, Board $board)
    {
        $this->authorize('update', $board);

        $data = $request->validated();
        $board = $this->boardService->update($data, $board->id);


        return new BoardResource($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Board $board
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Board $board)
    {
        $this->authorize('delete', $board);

        $this->boardService->destroy($board->id);

        return response()->json(['message' => 'Board was deleted']);
    }
}
