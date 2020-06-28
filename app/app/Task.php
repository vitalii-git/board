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

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function scopeFilterByLabels($query, array $id)
    {
        return $query->whereHas('labels', function ($q) use ($id) {
            $q->whereIn('label_id', $id);
        });
    }

    public function scopeFilterByStatus($query, $id)
    {
        return $query->whereHas('status', function ($q) use ($id) {
            $q->where('id', $id);
        });
    }
}
