<?php

namespace Modules\Book\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Book\Entities\Book;

class NotifyPublisherTheBookWasOutOfStock extends Mailable
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
        $book = $this->book;

        return $this->view('book::mails.out_of_stock')
            ->subject(__('app.mail.item_out_of_stock'))
            ->with([
                'book' => $book
            ]);
    }
}
