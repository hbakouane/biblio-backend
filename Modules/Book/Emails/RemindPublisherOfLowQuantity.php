<?php

namespace Modules\Book\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Book\Entities\Book;

class RemindPublisherOfLowQuantity extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Book $book
     */
    protected $book;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('book::mails.remind_publisher_of_low_quantity')
            ->with([
                'book' => $this->book
            ]);
    }
}
