<?php


namespace App\Services;


use App\Events\TaskEvent;
use App\Image;
use App\Log;
use App\Task;

class ImageService
{
    public $driver;

    public function __construct(ImageDriverService $imageDriverService)
    {
        $this->driver = $imageDriverService::generate();
    }

    /**
     * @param array $data
     * @param $image
     * @return mixed
     */
    public function store(array $data, $image)
    {
        $this->driver->store($data, $image);

        Image::create($data);
        $task = Task::find($data['task_id']);
        event(new TaskEvent($task, Log::ACTION_IMAGE_STORE));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        $image = Image::find($id);
        $this->driver->destroy($image);

        $task = Task::find($image->task_id);
        event(new TaskEvent($task, Log::ACTION_IMAGE_DESTROY));

        return $image->delete();
    }
}
