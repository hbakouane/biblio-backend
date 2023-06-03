<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\ListBooksRequest;
use Modules\Book\Transformers\BookResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class ListBooksController extends Controller
{
    /**
     * Fetch all the books
     *
     * @param ListBooksRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function list(ListBooksRequest $request)
    {
        $books = $this->getBooks();

        return $this->data([
            'books' => BookResource::collection($books)
        ]);
    }

    /**
     * Process fetching all the books
     * TODO: Add filtering
     *
     * @return Builder
     */
    private function getBooks()
    {
        return Book::query()
            ->with('publisher')
            ->get();
    }
}
