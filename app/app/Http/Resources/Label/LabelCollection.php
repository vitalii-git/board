<?php

namespace App\Http\Resources\Label;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LabelCollection extends ResourceCollection
{
    public $collects = LabelResource::class;
}
