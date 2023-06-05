<?php

use Modules\Order\Http\Controllers\AddNewOrderController;
use Modules\Order\Http\Controllers\AttachItemsToOrderController;

Route::middleware('auth:sanctum')
    ->prefix('orders')
    ->as('api.orders.')
    ->group(function () {
        /*
        ******************************************************
        *
        *                  Register an order
        *
        ******************************************************
        */
        Route::post('add', [AddNewOrderController::class, 'add'])
            ->name('add');

        /*
        ******************************************************
        *
        *             Routes for a specific order
        *
        ******************************************************
        */
        Route::prefix('{order}')
            ->as('single.')
            ->group(function () {
                /*
                ******************************************************
                *
                *              Attach items to an order
                *
                ******************************************************
                */
                Route::post('/items/attach', [AttachItemsToOrderController::class, 'attach'])
                    ->name('items.attach');
            });
    });
