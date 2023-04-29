<?php

namespace Modules\User\Http\Controllers\Settings;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Entities\Core;
use Modules\Core\Http\Controllers\CoreController as Controller;
use Modules\User\Http\Requests\Settings\UploadProfileImageRequest;

class UploadProfileImageController extends Controller
{
    /**
     * Upload a profile image for the user
     *
     * @param UploadProfileImageRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function uploadImage(UploadProfileImageRequest $request)
    {
        $image = $this->upload($request);

        return $this->success(
            __('app.user.settings.profile_photo_uploaded'),
            [
                'profile_image' => auth()->user()->getProfileImage($image)
            ]
        );
    }

    /**
     * Process uploading the profile picture
     *
     * @param UploadProfileImageRequest $request
     * @return null
     */
    private function upload(UploadProfileImageRequest $request)
    {
        $user = auth()->user();
        $collection = Core::COLLECTION_PROFILE_IMAGES;

        // Check if the user already has a profile image
        $profileImage = $user->getMedia($collection);

        if (filled($profileImage)) $user->clearMediaCollection($collection);

        return $this->uploadMedia(
            auth()->user(),
            $request->file('image'),
            $collection
        );
    }
}
