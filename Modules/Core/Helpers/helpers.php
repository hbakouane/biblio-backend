<?php

use \Carbon\Carbon;

if (! function_exists('formatDate')) {
    /**
     * Output date in a well-readable format
     *
     * @param $date
     * @return string
     */
    function formatDate($date)
    {
        return Carbon::parse($date)->format('dd-mm-yyyy');
    }
}
