<?php

namespace App\Jobs;

use App\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $imageService;
    private $data;
    private $file;

    /**
     * Create a new job instance.
     *
     * @param ImageService $imageService
     * @param array $data
     * @param $file
     */
    public function __construct(ImageService $imageService, array $data, $file)
    {
        $this->imageService = $imageService;
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->imageService->store($this->data, $this->file);
    }
}
