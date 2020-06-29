<?php

namespace App;



use Jenssegers\Mongodb\Eloquent\Model;

class Log extends Model
{
    const ACTION_STORE = 'Task created.';
    const ACTION_DESTROY = 'Task destroyed.';

    protected $collection = 'logs';

    protected $connection = 'mongodb';

    protected $fillable = [
        'action_name',
        'task_id',
        'user_id',
    ];

}
