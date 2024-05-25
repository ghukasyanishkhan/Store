<?php

namespace App\Jobs;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $itemIds;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $itemIds)
    {
        $this->userId = $userId;
        $this->itemIds = $itemIds;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $cardItems = Item::find($this->itemIds);
        foreach ($cardItems as $item) {
            $order = new Order();
            $order->user_id = $this->userId;
            $order->item_id = $item->id;
            $order->save();
        }
    }
}
