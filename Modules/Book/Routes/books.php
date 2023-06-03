<?php

use Modules\Book\Http\Controllers\ListBooksController;

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
    });
