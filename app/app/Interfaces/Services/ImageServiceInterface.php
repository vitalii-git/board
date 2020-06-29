<?php


namespace App\Interfaces\Services;


use Illuminate\Database\Eloquent\Model;

interface ImageServiceInterface
{
    public function store(array &$data, $file);

    public function destroy(Model $model);
}
