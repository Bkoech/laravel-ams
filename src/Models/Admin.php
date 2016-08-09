<?php

namespace Wilgucki\LaravelAms\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'meta', 'is_superadmin'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('Wilgucki\LaravelAms\Models\Role');
    }

    public function passwords()
    {
        return $this->hasMany('Wilgucki\LaravelAms\Models\PasswordHistory');
    }

    public function setPasswordAttribute($value)
    {
        if ($value != '') {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public static function boot()
    {
        parent::boot();
        static::saved(function (Admin $admin) {
            if (!isset($admin->getOriginal()['password']) || $admin->getOriginal()['password'] != $admin->password) {
                PasswordHistory::create([
                    'admin_id' => $admin->id,
                    'password' => $admin->password
                ]);
            }
        });
    }
}
