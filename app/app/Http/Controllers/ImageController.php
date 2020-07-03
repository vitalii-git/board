<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreRequest;
use App\Image;
use App\Jobs\ProcessImage;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only(['task_id']);
        $data['user_id'] = $request->user()->id;
        $file = base64_encode(file_get_contents($request->file('image')));

        $processImageJob = new ProcessImage($this->imageService, $data, $file);
        $this->dispatch($processImageJob);

        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Image $image)
    {
        $this->authorize('delete', $image);
        $this->imageService->destroy($image->id);

        return response()->json(['message' => 'Success']);
    }
}
