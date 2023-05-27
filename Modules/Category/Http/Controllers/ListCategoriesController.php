<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Http\Response;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Filters\CategoryFilter;
use Modules\Category\Http\Requests\ListCategoriesRequest;
use Modules\Category\Transformers\CategoryResource;
use Modules\Core\Http\Controllers\CoreController as Controller;

class ListCategoriesController extends Controller
{
    /**
     * Get a list of the categories that we have in the database
     *
     * @param ListCategoriesRequest $request
     * @param CategoryFilter $filter
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function list(ListCategoriesRequest $request, CategoryFilter $filter)
    {
        /** @var $categories */
        $categories = $this->fetchCategories($filter, $request);

        return $this->paginatedData(
            $categories,
            CategoryResource::class
        );
    }

    /**
     * Fetch all the categories, paginate and filter them
     *
     * @return Builder
     */
    private function fetchCategories($filter, $request)
    {
        $categories = Category::query()
            ->with('creator')
            ->get();

//        dd($this->filter($categories, $filter));

        return $this->paginate($categories);
    }
}
