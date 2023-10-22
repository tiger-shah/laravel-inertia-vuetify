<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Core\Traits\HasData;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasData, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile',
        'gender',
        'birthday',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'has_profile',
        'created_at',
        'updated_at',
        'verified_by',
        'verified_at',
        'banded_by',
        'banded_at',
    ];

    /**
     * @var array
     */
    const Genders = [
        1   => ['name' => 'male'],
        2   => ['name' => 'female'],
    ];
}
