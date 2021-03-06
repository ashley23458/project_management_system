<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Company');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function defaultCompany()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role_id === self::ROLE_ADMIN;
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}
