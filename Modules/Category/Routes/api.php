<?php

use Illuminate\Http\Request;
use Modules\Category\Http\Controllers\ListCategoriesController;
use Modules\Category\Http\Controllers\AddCategoryController;
use Modules\Category\Http\Controllers\DeleteCategoryController;
use Modules\Category\Http\Controllers\EditCategoryController;
use Modules\Category\Http\Controllers\UpdateCategoryStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->prefix('categories')->as('api.categories.')->group(function () {
    /*
     ******************************************************
     *
     *                  List categories
     *
     ******************************************************
     */
    Route::get('/list', [ListCategoriesController::class, 'list'])
        ->name('list');

    /*
     ******************************************************
     *
     *                 Add a new category
     *
     ******************************************************
     */
    Route::post('/add', [AddCategoryController::class, 'add'])
        ->name('add');

    /*
     ******************************************************
     *
     *             Routes for a specific category
     *
     ******************************************************
     */
    Route::prefix('{category}')->group(function () {
        /*
         ******************************************************
         *
         *                 Update a category
         *
         ******************************************************
         */
        Route::patch('/update', [EditCategoryController::class, 'update'])
            ->name('update');

        /*
         ******************************************************
         *
         *                Update category status
         *
         ******************************************************
         */
        Route::patch('/status/update', [UpdateCategoryStatusController::class, 'update'])
            ->name('status.update');

        /*
         ******************************************************
         *
         *                 Delete a category
         *
         ******************************************************
         */
        Route::delete('/delete', [DeleteCategoryController::class, 'delete'])
            ->name('delete');
    });
});
