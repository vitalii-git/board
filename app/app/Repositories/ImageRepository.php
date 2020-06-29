<?php


namespace App\Repositories;


use App\Events\TaskEvent;
use App\Factories\ImageDriverFactory;
use App\Image;
use App\Interfaces\Repositories\ImageRepositoryInterface;
use App\Log;
use App\Task;
use Illuminate\Support\Facades\Auth;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @param array $data
     * @param $image
     * @return mixed
     */
    public function store(array $data, $image)
    {
        $data = [];
        $imageService = ImageDriverFactory::createImageDriver(env('IMAGE_DRIVER'));
        $imageService->store($data, $image);

        Image::create($data);
        $task = Task::find($data['task_id']);
        event(new TaskEvent($task, Log::ACTION_IMAGE_STORE));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $image = Image::find($id);
        if (Auth::user()->can('delete', $image)) {
            $imageService = ImageDriverFactory::createImageDriver(env('IMAGE_DRIVER'));
            $imageService->destroy($image);

            $task = Task::find($image->task_id);
            event(new TaskEvent($task, Log::ACTION_IMAGE_DESTROY));
            $image->delete();
        }
        return false;
    }

}
