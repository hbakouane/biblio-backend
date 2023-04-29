<?php

use Modules\User\Http\Controllers\Settings\UploadProfileImageController;
use Modules\User\Http\Controllers\Settings\RemoveProfileImageController;

Route::middleware('auth:sanctum')
    ->prefix('user/settings')
    ->as('api.user.settings.')
    ->group(function () {
        /*
         ******************************
         *    Upload Profile Image
         *******************************
         */
        Route::post('/upload-profile-image', [UploadProfileImageController::class, 'uploadImage'])
            ->name('upload_profile_image');

        /*
         ******************************
         *    Remove Profile Image
         *******************************
         */
        Route::delete('/remove-profile-image', [RemoveProfileImageController::class, 'remove'])
            ->name('remove_profile_image');
    });
