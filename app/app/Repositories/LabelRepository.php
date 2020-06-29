<?php


namespace App\Repositories;


use App\Interfaces\Repositories\LabelRepositoryInterface;
use App\Label;
use Illuminate\Support\Facades\Auth;

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
        $data['user_id'] = Auth::user()->id;
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
        if (Auth::user()->can('update', $label)) {
            $data['user_id'] = Auth::user()->id;
            return tap($label)->update($data);
        }
        return false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $label = Label::find($id);
        if (Auth::user()->can('delete', $label)) {
            return Label::where('id', $id)->delete();
        }
        return false;
    }

}
