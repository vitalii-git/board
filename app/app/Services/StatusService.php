<?php


namespace App\Services;


use App\Status;
use Illuminate\Support\Facades\DB;

class StatusService
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Status::paginate();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $status = Status::create($data);
            DB::commit();

            return $status;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Status::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $status = Status::findOrFail($id);
            $status = tap($status)->update($data);
            DB::commit();

            return $status;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $status = Status::where('id', $id)->delete();
            DB::commit();

            return $status;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }
}
