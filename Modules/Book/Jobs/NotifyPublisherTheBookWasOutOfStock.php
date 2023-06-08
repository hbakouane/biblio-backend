<?php

namespace Modules\Book\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Book\Entities\Book;
use Modules\Book\Emails\NotifyPublisherTheBookWasOutOfStock as NotifyPublisherTheBookWasOutOfStockMail;

class NotifyPublisherTheBookWasOutOfStock implements ShouldQueue
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
        $book = $this->book;

        Mail::to($book->publisher->user->email)
            ->send(new NotifyPublisherTheBookWasOutOfStockMail($book));
    }
}
