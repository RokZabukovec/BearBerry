<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    /**
     * @return HasMany
     */
    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->first();
    }

    public function hasRole(string $role)
    {
        if ($this->role() && $this->role()->name == $role)
        {
            return true;
        }

      return  false;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
