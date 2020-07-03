<?php


namespace App\Services;


use App\Label;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LabelService
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Label::own(Auth::user()->id)->paginate();
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
            $label = Label::create($data);
            DB::commit();

            return $label;
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
        return Label::own(Auth::user()->id)->find($id);
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
            $data['user_id'] = Auth::user()->id;
            $label = Label::findOrFail($id);
            $label = tap($label)->update($data);
            DB::commit();

            return $label;
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
            $label = Label::where('id', $id)->delete();
            DB::commit();

            return $label;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }
}
