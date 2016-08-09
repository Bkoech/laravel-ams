<?php

namespace Wilgucki\LaravelAms\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    protected $fillable = [
        'admin_id', 'password'
    ];
}
