<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Image\ImageCollection;
use App\Http\Resources\Label\LabelCollection;
use App\Http\Resources\Status\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => new StatusResource($this->status),
            'labels' => new LabelCollection($this->labels),
            'images' => new ImageCollection($this->images),
        ];
    }
}
