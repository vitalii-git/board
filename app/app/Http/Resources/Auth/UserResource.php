<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource->load(
            'board',
            'board.tasks',
            'board.tasks.labels',
            'board.tasks.status',
            'board.tasks.images'
        );
        return parent::toArray($request);
    }
}
