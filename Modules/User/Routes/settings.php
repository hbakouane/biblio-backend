<?php

use Modules\User\Http\Controllers\Settings\UploadProfileImageController;

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
    });
