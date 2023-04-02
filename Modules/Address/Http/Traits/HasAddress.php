<?php

namespace Modules\Address\Http\Traits;

trait HasAddress
{
    /**
     * Get the full address for humans
     *
     * @return string
     */
    public function getAddressForHumans()
    {
        $address = $this->address;

        return $address->address_line_1 . ', '
            . ($address->address_line_2 ? $address->address_line_2 . ', ' : null)
            . $address->state . ', '
            . $address->city . ' ' . $address->zip . ', '
            . $address->country->short_name;
    }
}
