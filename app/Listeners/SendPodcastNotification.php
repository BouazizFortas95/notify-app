<?php

namespace App\Listeners;

use App\Events\PodcastProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class SendPodcastNotification implements ShouldQueue
{

    use InteractsWithQueue;

    public $afterCommit = true;

    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PodcastProcessed $event): void
    {
        if (true) {
            $this->release(30);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(PodcastProcessed $event, Throwable $exception): void
    {
        // ...
    }
}
