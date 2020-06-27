<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskLabel extends Model
{
    protected $fillable = [
        'task_id',
        'label_id'
    ];
}
