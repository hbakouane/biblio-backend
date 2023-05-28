<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\EditCategoryRequest;
use Modules\Category\Transformers\CategoryResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class EditCategoryController extends Controller
{
    /**
     * Update category
     *
     * @param EditCategoryRequest $request
     * @param Category $category
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
        $category = $this->applyChanges($category, $request);

        return $this->success(
            __('app.category.update.updated'),
            new CategoryResource($category)
        );
    }

    /**
     * Apply changes to the category object
     *
     * @param $category
     * @param $request
     * @return mixed
     */
    private function applyChanges($category, $request)
    {
        $data = $request->only(['name', 'description', 'category']);

        $category->update($data);

        return $category;
    }
}
