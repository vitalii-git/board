<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'board_id',
        'status_id',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'task_labels');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
