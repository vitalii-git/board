<?php

namespace App\Http\Resources\Board;

use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\Task\TaskCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => new UserResource($this->user),
            'tasks' => new TaskCollection($this->tasks),
        ];
    }
}
