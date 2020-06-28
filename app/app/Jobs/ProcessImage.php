<?php

namespace App\Jobs;

use App\Interfaces\Repositories\ImageRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $imageRepository;
    private $data;
    private $file;

    /**
     * Create a new job instance.
     *
     * @param ImageRepositoryInterface $imageRepository
     * @param array $data
     * @param $file
     */
    public function __construct(ImageRepositoryInterface $imageRepository, array $data, $file)
    {
        $this->imageRepository = $imageRepository;
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
        $this->imageRepository->store($this->data, $this->file);
    }
}
