<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function scopeOwn($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
