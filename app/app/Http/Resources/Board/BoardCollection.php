<?php

namespace App\Http\Resources\Board;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BoardCollection extends ResourceCollection
{
    public $collects = BoardResource::class;
}
