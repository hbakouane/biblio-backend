<?php

namespace Modules\Book\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Book\Entities\Book;
use Modules\Book\Http\Requests\AddNewBookRequest;
use Modules\Book\Transformers\BookResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class AddNewBookController extends Controller
{
    /**
     * Add a new book
     *
     * @param AddNewBookRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function add(AddNewBookRequest $request)
    {
        $book = $this->addBook($request);

        return $this->success(
            __('app.book.add.added'),
            new BookResource($book)
        );
    }

    /**
     * Process adding a new book
     *
     * @param $request
     * @return mixed
     */
    private function addBook($request)
    {
        DB::transaction(function () use (&$book, $request) {
            $book = Book::createBook(
                $request->get('title'),
                $request->get('author'),
                $request->get('category_id'),
                $request->get('price'),
                $request->get('quantity'),
                $request->get('publisher_id')
            );

            $this->updateDetails($book, $request);
        });

        return $book->load('publisher');
    }

    /**
     * Update details of the created book
     *
     * @param $book
     * @param $request
     * @return mixed
     */
    private function updateDetails($book, $request)
    {
        return $book->update([
            'excerpt' => $request->get('excerpt'),
            'description' => $request->get('description')
        ]);
    }
}
