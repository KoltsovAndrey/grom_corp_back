<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'second_name', 'middle_name', 'login', 'password', 'role_id', 'post_id', 'department_id', 'email', 'phone', 'phone_city', 'photo',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', "created_at", "updated_at",
        // 'role_id', 'post_id', 'department_id',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function role()
    {
        return $this->belongsTo("App\Role");
    }

    public function department()
    {
        return $this->belongsTo("App\Department");
    }

    public function post()
    {
        return $this->belongsTo("App\Post");
    }

    public function journal()
    {
        return $this->hasMany("App\User");
    }
}
