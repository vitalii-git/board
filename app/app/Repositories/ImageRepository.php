<?php


namespace App\Repositories;


use App\Image;
use App\Interfaces\Repositories\ImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageRepository implements ImageRepositoryInterface
{
    /**
     * @param array $data
     * @param $image
     * @return mixed
     */
    public function store(array $data, $image)
    {
        $intervention = \InterventionImage::make(base64_decode($image));

        $random = Str::random(32);
        $desktopName = $random . '_desktop.jpg';
        $mobileName = $random. '_mobile.jpg';
        $fitSize = config('image.size.mobile.fit');

        Storage::disk('tasks')->put($desktopName, (string) $intervention->encode());
        Storage::disk('tasks')->put($mobileName, (string) $intervention->fit($fitSize)->encode());

        $data['desktop_url'] = $desktopName;
        $data['mobile_url'] = $mobileName;

        return Image::create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        if ($image = Image::find($id)) {
            if (Storage::disk('tasks')->exists($image->desktop_url)) {
                Storage::disk('tasks')->delete($image->desktop_url);
            }
            if (Storage::disk('tasks')->exists($image->mobile_url)) {
                Storage::disk('tasks')->delete($image->mobile_url);
            }
            return $image->delete();
        }

        return true;
    }

}
