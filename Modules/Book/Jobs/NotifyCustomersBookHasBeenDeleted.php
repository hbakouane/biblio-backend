<?php

namespace Modules\Book\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Book\Entities\Book;
use Modules\Order\Entities\OrderItem;
use Modules\Book\Emails\NotifyCustomersBookHasBeenDeleted as NotifyCustomersBookHasBeenDeletedMail;

class NotifyCustomersBookHasBeenDeleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Book
     */
    protected Book $book;

    /**
     * @var array
     */
    protected array $emails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book, array $emails)
    {
        $this->book = $book;

        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->emails)
            ->send(new NotifyCustomersBookHasBeenDeletedMail($this->book));
    }
}
