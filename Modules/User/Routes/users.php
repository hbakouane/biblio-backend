<?php

use Modules\User\Http\Controllers\ShowUserController;

Route::middleware('auth:sanctum')
    ->prefix('users')
    ->as('api.users.')
    ->group(function () {
        /*
         ******************************************************
         *
         *                Routes for a specific
         *                        user
         *
         ******************************************************
         */
        Route::prefix('{user}')
            ->group(function () {
                /*
                 ******************************************************
                 *
                 *                  Fetch a user
                 *
                 ******************************************************
                 */
                Route::get('/fetch', [ShowUserController::class, 'show'])
                    ->name('single.fetch');
            });
    });
