<?php


namespace App\Repositories;


use App\Board;
use App\Interfaces\Repositories\BoardRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BoardRepository implements BoardRepositoryInterface
{

    /**
     * @return mixed
     */
    public function index()
    {
        return Board::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $data['user_id'] = Auth::user()->id;

        return Board::create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Board::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        $board = Board::find($id);
        if (Auth::user()->can('update', $board)) {
            return tap($board)->update($data);
        }
        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $board = Board::find($id);

        if ($status = Auth::user()->can('delete', $board)) {
            return $board->delete();
        }
        return false;
    }

}
