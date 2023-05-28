<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Entities\Core;
use Modules\Core\Http\Filters\QueryFilter;
use Modules\User\Entities\User;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CoreController extends Controller
{
    /**
     * Return response for data
     *
     * @param $data
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function data($data = [])
    {
        return response([
            'message' => $message ?? __('app.response.success'),
            'data' => $data
        ]);
    }

    public function paginatedData($paginated, $resource)
    {
        // TODO: Complete pagination
        $data = [];

        $data['items'] = array_values($resource::collection($paginated['data'])
            ->resource
            ->toArray());

        unset($paginated['data']);

        $data = array_merge($data, $paginated);
//        dd($data['items']->resource->toArray());
        dd($data);

        return $this->data($data);
    }

    /**
     * Handle the success response
     *
     * @param $message
     * @param $data
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function success($message = null, $data = null, $status = 200)
    {
        $res = [
            'message' => $message ?? __('app.response.success')
        ];

        if ($data) $res['data'] = $data;

        return response($res, $status);
    }

    /**
     * Handle the invalid request response
     *
     * @param $message
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function invalid($message = null)
    {
        return response([
            'message' => $message ?? __('app.response.invalid')
        ]);
    }

    /**
     * Paginate a list of data
     *
     * @param $data
     * @return LengthAwarePaginator
     */
    public function paginate($data)
    {
        $data = collect($data);

        return (new LengthAwarePaginator(
            $data,
            $data->count(),
            Core::ITEMS_PER_PAGE
        ))->toArray();
    }

    public function filter($model, $filter)
    {
        return QueryFilter::apply($model, $filter);
    }

    /**
     * Uploads the given media to a collection
     *
     * @param User|Model $model
     * @param $media
     * @param string $collection
     * @param string|null $name
     * @param string|null $fileName
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function uploadMedia(
        User|Model $model,
        $media,
        string $collection,
        string $name = null,
        string $fileName = null
    )
    {
        $media = $model->addMedia($media);

        if ($name) $media->usingName($name);

        if ($fileName) $media->usingFileName($fileName);

        return $media->toMediaCollection($collection);
    }
}
