<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CoreController extends Controller
{
    /**
     * Handle the success response
     *
     * @param $message
     * @param $data
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function success($message = null, $data = null)
    {
        $res = [
            'message' => $message ?? __('app.response.success')
        ];

        if ($data) $res['data'] = $data;

        return response($res, 200);
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
}
