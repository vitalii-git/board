<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreRequest;
use App\Interfaces\Repositories\ImageRepositoryInterface;
use App\Jobs\ProcessImage;

class ImageController extends Controller
{
    private $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
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

        $processImageJob = new ProcessImage($this->imageRepository, $data, $file);
        $this->dispatch($processImageJob);

        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->imageRepository->destroy($id);

        return response()->json(['message' => 'Success'], 200);
    }
}
