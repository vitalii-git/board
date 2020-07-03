<?php


namespace App\Services;


class ImageDriverService
{
    public static $drivers = [
        'intervention' => InterventionImageService::class,
    ];

    public static function generate()
    {
        $driver = env('IMAGE_DRIVER', 'intervention');
        if (array_key_exists($driver, static::$drivers)) {
            return new static::$drivers[$driver];
        } else {
            return new static::$drivers['intervention'];
        }
    }
}
