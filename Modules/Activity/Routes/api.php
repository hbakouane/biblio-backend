<?php

use Modules\Activity\Http\Controllers\ListActivitiesController;

Route::prefix('activities')
    ->as('api.activities.')
    ->group(function() {
        /*
         ******************************************
         *          List all the countries
         ******************************************
         */
        Route::get('/list', [ListActivitiesController::class, 'list'])
            ->name('list');
    });
