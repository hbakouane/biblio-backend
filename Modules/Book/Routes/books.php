<?php

use Modules\Book\Http\Controllers\ListBooksController;
use Modules\Book\Http\Controllers\AddNewBookController;

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
    });
