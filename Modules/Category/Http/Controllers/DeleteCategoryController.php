<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\DeleteCategoryRequest;
use Modules\Core\Http\Controllers\CoreController as Controller;

class DeleteCategoryController extends Controller
{
    /**
     * Delete the given category
     *
     * @param DeleteCategoryRequest $request
     * @param Category $category
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function delete(DeleteCategoryRequest $request, Category $category)
    {
        $this->deleteCategory($category);

        return $this->success(
            __('app.category.delete.deleted')
        );
    }

    /**
     * Process deleting the category
     *
     * @param Category $category
     * @return bool|null
     */
    private function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}
