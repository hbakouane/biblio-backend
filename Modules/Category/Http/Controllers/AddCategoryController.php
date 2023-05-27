<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\AddCategoryRequest;
use Modules\Category\Transformers\CategoryResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class AddCategoryController extends Controller
{
    /**
     * Add a new category
     *
     * @param AddCategoryRequest $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function add(AddCategoryRequest $request)
    {
        $category = $this->addCategory($request);

        return $this->success(
            __('app.category.add.added'),
            new CategoryResource($category)
        );
    }

    /**
     * Process creating a new category
     *
     * @param $request
     * @return mixed
     */
    private function addCategory($request)
    {
        $category = Category::createCategory(
            $request->get('name'),
            $request->get('description'),
            auth()->user()
        );

        return $category->load('creator');
    }
}
