<?php


namespace App\Repositories;


use App\Interfaces\Repositories\LabelRepositoryInterface;
use App\Label;

class LabelRepository implements LabelRepositoryInterface
{

    /**
     * @return mixed
     */
    public function index()
    {
        return Label::all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return Label::create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Label::find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update(array $data, int $id)
    {
        $label = Label::find($id);

        return tap($label)->update($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return Label::where('id', $id)->delete();
    }

}
