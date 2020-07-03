<?php

namespace App\Http\Resources\Status;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StatusCollection extends ResourceCollection
{
    public $collects = StatusResource::class;
}
