<?php

namespace Wilgucki\LaravelAms\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function acl()
    {
        return $this->belongsToMany('Wilgucki\LaravelAms\Models\AclResource');
    }

    public static function forSelect()
    {
        return static::orderBy('name')->get()->pluck('name', 'id')->toArray();
    }
}
