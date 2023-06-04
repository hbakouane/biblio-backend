<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\DeleteBookRequest;
use Modules\Core\Http\Controllers\CoreController as Controller;

class DeleteBookController extends Controller
{
    /**
     * Delete a book
     *
     * @param DeleteBookRequest $request
     * @param Book $book
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function delete(DeleteBookRequest $request, Book $book)
    {
        $this->destroy($book);

        return $this->success(
            __('app.book.delete.deleted')
        );
    }

    /**
     * Process deleting a book
     *
     * @param $book
     * @return mixed
     */
    private function destroy($book)
    {
        return $book->delete();
    }
}
