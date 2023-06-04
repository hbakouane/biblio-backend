<?php

use Modules\Book\Http\Controllers\ListBooksController;
use Modules\Book\Http\Controllers\AddNewBookController;
use Modules\Book\Http\Controllers\DeleteBookController;
use Modules\Book\Http\Controllers\UpdateBookController;

Route::middleware('auth:sanctum')
    ->prefix('books')
    ->as('api.books.')
    ->group(function () {
        /*
         ******************************************************
         *
         *               List all the categories
         *
         ******************************************************
         */
        Route::get('/list', [ListBooksController::class, 'list'])
            ->name('list');

        /*
         ******************************************************
         *
         *                    Add a new book
         *
         ******************************************************
         */
        Route::post('add', [AddNewBookController::class, 'add'])
            ->name('add');

        /*
         ******************************************************
         *
         *              Routes for a specific book
         *
         ******************************************************
         */
        Route::prefix('{book}')
            ->group(function () {
                /*
                ******************************************************
                *
                *                     Update a book
                *
                ******************************************************
                */
                Route::patch('/update', [UpdateBookController::class, 'update'])
                    ->name('update');

                /*
                ******************************************************
                *
                *                    Delete a book
                *
                ******************************************************
                */
                Route::delete('/delete', [DeleteBookController::class, 'delete'])
                    ->name('delete');
            });
    });
