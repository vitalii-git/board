<?php


namespace App\Services;


use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InterventionImageService implements ImageServiceInterface
{

    /**
     * @param $data
     * @param $file
     * @return mixed
     */
    public function store(&$data, $file)
    {
        $intervention = \InterventionImage::make(base64_decode($file));

        $random = Str::random(32);
        $desktopName = $random . '_desktop.jpg';
        $mobileName = $random. '_mobile.jpg';
        $fitSize = config('image.size.mobile.fit');

        Storage::disk('tasks')->put($desktopName, (string) $intervention->encode());
        Storage::disk('tasks')->put($mobileName, (string) $intervention->fit($fitSize)->encode());

        $data['desktop_url'] = $desktopName;
        $data['mobile_url'] = $mobileName;
    }

    /**
     * @param Model $image
     * @return mixed
     */
    public function destroy(Model $image)
    {
        if (Storage::disk('tasks')->exists($image->desktop_url)) {
            Storage::disk('tasks')->delete($image->desktop_url);
        }
        if (Storage::disk('tasks')->exists($image->mobile_url)) {
            Storage::disk('tasks')->delete($image->mobile_url);
        }
    }
}
