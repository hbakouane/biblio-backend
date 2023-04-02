<?php

namespace Modules\Country\Http\Traits;

trait CountryMethods {
    /**
     * Get a random country
     *
     * @return mixed
     */
    public static function random()
    {
        return self::whereNotNull('code')
            ->inRandomOrder()
            ->first();
    }

    /**
     * Add a new country to the database
     *
     * @param string|null $code
     * @param string|null $shortName
     * @param string|null $fullName
     * @param integer|null $callingCode
     * @param string|null $capital
     * @param string|null $currency
     * @param string|null $citizenship
     * @param string|null $flag
     * @return mixed
     */
    public static function createCountry(
        ? string $code,
        ? string $shortName,
        ? string $fullName,
        ? int $callingCode,
        ? string $capital,
        ? string $currency,
        ? string $citizenship,
        ? string $flag
    )
    {
        return self::create([
            'code' => $code,
            'short_name' => $shortName,
            'full_name' => $fullName,
            'calling_code' => $callingCode,
            'capital' => $capital,
            'currency' => $currency,
            'citizenship' => $citizenship,
            'flag' => $flag
        ]);
    }
}
