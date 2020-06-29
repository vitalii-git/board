<?php


namespace App\Factories;


use App\Interfaces\Factories\ImageDriverFactoryInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Services\InterventionImageService;

class ImageDriverFactory implements ImageDriverFactoryInterface
{
    public static $drivers = [
        'intervention' => InterventionImageService::class,
    ];

    /**
     * @param $driver
     * @return mixed
     */
    public static function createImageDriver($driver) : ImageServiceInterface
    {
        if (array_key_exists($driver, static::$drivers)) {
            return new static::$drivers[$driver];
        } else {
            return new static::$drivers['intervention'];
        }
    }
}
