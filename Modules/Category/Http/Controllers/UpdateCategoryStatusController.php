<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\UpdateCategoryStatusRequest;
use Modules\Core\Http\Controllers\CoreController as Controller;

class UpdateCategoryStatusController extends Controller
{
    /**
     * Update category's status
     *
     * @param UpdateCategoryStatusRequest $request
     * @param Category $category
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function update(UpdateCategoryStatusRequest $request, Category $category)
    {
        $this->updateStatus($category, $request);

        return $this->success(
            __('app.category.update.status.updated')
        );
    }

    /**
     * Process updating the category's status
     *
     * @param $category
     * @param $request
     * @return mixed
     */
    private function updateStatus($category, $request)
    {
        return $category->update([
            'status' => $request->get('status')
        ]);
    }
}
