<?php

namespace Modules\Country\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Country\Http\Traits\CountryMethods;

class Country extends Model
{
    use HasFactory, Uuids, CountryMethods;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [
        'code',
        'short_name',
        'full_name',
        'calling_code',
        'capital',
        'currency',
        'citizenship',
        'flag'
    ];
}
