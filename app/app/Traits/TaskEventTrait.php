<?php


namespace App\Traits;


use App\Events\TaskEvent;
use Illuminate\Database\Eloquent\Model;

trait TaskEventTrait
{
    public function logTaskEvents(Model $model)
    {
        $changedFields = $model->getChanges();
        unset($changedFields[$model->getUpdatedAtColumn()]);

        foreach ($changedFields as $key => $value) {
            $action = ucfirst($key) . " changed";
            event(new TaskEvent($model, $action));
        }
    }
}
