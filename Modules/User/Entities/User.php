<?php

namespace Modules\User\Entities;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
 use Modules\User\Database\factories\UserFactory;
 use Modules\User\Http\Traits\UserMethods;
 use Modules\User\Http\Traits\UserRelationships;
 use Spatie\MediaLibrary\HasMedia;
 use Spatie\MediaLibrary\InteractsWithMedia;

 class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,
        Uuids, UserMethods, UserRelationships,
        InteractsWithMedia;

    /**
     * Mass-assignable attributes
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Possible user statuses
     */
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';


     /** TODO: Remove this when app is in production
      * Temporary password user for development
      */
     const TEMP_PASSWORD = '12345678';

     /**
      * Attach the model's factory class
      *
      * @return UserFactory
      */
     protected static function newFactory()
     {
         return UserFactory::new();
     }
}
