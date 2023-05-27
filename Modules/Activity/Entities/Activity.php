<?php

namespace Modules\Activity\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\Activity\Http\Traits\ActivityRelationships;
use Modules\Activity\Http\Traits\ActivityMethods;

class Activity extends Model
{
    use HasFactory, Uuids, ActivityRelationships,
        ActivityMethods;

    /**
     * Mass-assignable attributes
     *
     * @var array[]
    */
    protected $fillable = [
        'user',
        'key',
        'extra'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'extra' => 'array'
    ];

    /**
     * All possible activity keys
     */
    const ACTIVITY_KEY_USER_SIGNED_UP = 'user.signed_up';
    const ACTIVITY_KEY_USER_LOGGED_IN = 'user.logged_in';
    const ACTIVITY_KEY_USER_LOGGED_OUT = 'user.logged_out';
    const ACTIVITY_KEY_USER_EMAIL_CHANGED = 'user.email_changed';
}
