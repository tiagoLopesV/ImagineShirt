<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'blocked',
        'photo_url'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'id');
    }

    protected function fullPhotoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->photo_url ? asset('storage/photos/' . $this->photo_url) : asset('/img/avatar_unknown.png');
            },
        );
    }
}