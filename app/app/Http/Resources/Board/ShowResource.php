<?php

namespace App\Http\Resources\Board;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource->load('tasks', 'tasks.labels', 'tasks.status', 'tasks.images');
        return parent::toArray($request);
    }
}
