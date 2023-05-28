<?php

use Modules\Activity\Http\Controllers\ListActivitiesController;
use Modules\Activity\Http\Controllers\AddActivityController;

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

        /*
         ******************************************
         *            Add new activity
         ******************************************
         */
        Route::post('/add', [AddActivityController::class, 'add'])
            ->name('add');
    });
