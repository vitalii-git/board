<?php


namespace App\Interfaces\Repositories;


interface ImageRepositoryInterface
{
    public function store(array $data, $image);

    public function destroy(int $id);
}
