<?php

namespace Modules\User\Http\Controllers\Settings;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Core\Entities\Core;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\User\Http\Requests\Settings\RemoveProfileImageRequest;

class RemoveProfileImageController extends Controller
{
    /**
     * Delete the user's profile image
     *
     * @param RemoveProfileImageRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function remove(RemoveProfileImageRequest $request)
    {
        $user = auth()->user();
        $images = $user->getMedia(Core::COLLECTION_PROFILE_IMAGES);

        if ($images->isEmpty()) return $this->invalid(__('app.user.settings.profile_photo_doesnt_exist'));

        $this->deleteProfileImage($images);

        return $this->success(
            __('app.user.settings.profile_photo_deleted')
        );
    }

    /**
     * Process deleting the user's profile image
     *
     * @param $images
     * @return mixed
     */
    private function deleteProfileImage($images)
    {
        return $images[0]->delete();
    }
}
