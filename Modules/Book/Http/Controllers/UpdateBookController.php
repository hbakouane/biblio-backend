<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\UpdateBookRequest;
use Modules\Book\Transformers\BookResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class UpdateBookController extends Controller
{
    /**
     * Update the book information
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->applyChanges($book, $request);

        return $this->success(
            __('app.book.update.updated'),
            new BookResource($book)
        );
    }

    /**
     * Process updating the book
     *
     * @param Book $book
     * @param UpdateBookRequest $request
     * @return Book
     */
    private function applyChanges(Book $book, UpdateBookRequest $request)
    {
        $data = $request->validated();

        $book->update($data);

        return $book;
    }
}
