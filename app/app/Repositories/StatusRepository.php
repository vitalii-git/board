<?php


namespace App\Repositories;


use App\Interfaces\Repositories\StatusRepositoryInterface;
use App\Status;

class StatusRepository implements StatusRepositoryInterface
{

    /**
     * @return mixed
     */
    public function index()
    {
        return Status::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Status::create($data);
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
        $status = Status::find($id);

        return tap($status)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return Status::where('id', $id)->delete();
    }

}
