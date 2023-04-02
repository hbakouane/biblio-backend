<?php

namespace Modules\Address\Http\Traits;

trait AddressRelationships
{
    /**
     * Associate the address to a model
     *
     * @return mixed
     */
    public function owner()
    {
        return $this->morphTo();
    }
}
