<?php

namespace Modules\Book\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Book\Entities\Book;

class NotifyCustomersBookHasBeenDeleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Book
     */
    protected Book $book;

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
        return $this->subject('Your order has been updated')
            ->view('book::mails.notify_customer_book_has_been_deleted')
            ->with([
                'book' => $this->book
            ]);
    }
}
