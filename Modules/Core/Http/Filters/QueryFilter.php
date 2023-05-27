<?php

namespace Modules\Core\Http\Filters;

class QueryFilter
{
    /**
     * Apply filters on the model
     *
     * @param $model
     * @param $filter
     * @return void
     */
    public static function apply($resources, $filter)
    {
        /** @var $request */
        $request = request();

        dd($resources->get());
    }
}
