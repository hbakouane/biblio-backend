<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Uuids;
use Modules\User\Entities\User;

class Profile extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'country_id',
        'dob',
        'note',
        'website',
        'phone_country_id',
        'phone_number',
        'status',
        'last_logged_in'
    ];

    public function getPhoneNumberForHumans()
    {
        return $this->country->calling_code . $this->phone_number;
    }

    public function scopeActive($query)
    {
        return $query->where('status', User::STATUS_ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', User::STATUS_INACTIVE);
    }

    protected static function newFactory()
    {
        return \Modules\Profile\Database\factories\ProfileFactory::new();
    }
}
