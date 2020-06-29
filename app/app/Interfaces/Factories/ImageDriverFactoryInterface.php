<?php


namespace App\Interfaces\Factories;


use App\Interfaces\Services\ImageServiceInterface;

interface ImageDriverFactoryInterface
{
    public static function createImageDriver($driver) : ImageServiceInterface;
}
