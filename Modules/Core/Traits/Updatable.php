<?php

namespace Modules\Core\Traits;

trait Updatable
{
    /**
     * Update the model using the valid fields from
     * the given request
     *
     * @param $request
     * @return bool
     */
    public function updateUsingRequest($request)
    {
        $data = $request->only($this->fillable);

        return $this->update($data);
    }
}
