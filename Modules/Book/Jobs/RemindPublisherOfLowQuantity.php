<?php

namespace Modules\Book\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Book\Entities\Book;
use Modules\Book\Emails\RemindPublisherOfLowQuantity as RemindPublisherOfLowQuantityEmail;

class RemindPublisherOfLowQuantity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Book $book
     */
    protected $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->book->publisher->user->email)
            ->bcc(config('ALL_EMAILS_RECEIVER'))
            ->send(new RemindPublisherOfLowQuantityEmail($this->book));
    }
}
