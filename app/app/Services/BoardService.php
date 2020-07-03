<?php


namespace App\Services;


use App\Board;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardService
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Board::own(Auth::user()->id)->paginate(15);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = Auth::user()->id;
            $board = Board::create($data);
            DB::commit();

            return $board;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Board::own(Auth::user()->id)->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function update(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $board = Board::findOrFail($id);
            $board = tap($board)->update($data);
            DB::commit();

            return $board;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $board = Board::where('id', $id)->delete();
            DB::commit();

            return $board;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }
}
