<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use App\Services\UpdateOrderService;


class UpdateOrderApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
    $item
    )
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $item = $this->item;
            (app(UpdateOrderService::class)->updateOrderProvider($item));
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::error($e->getMessage());
        }
    }
}
