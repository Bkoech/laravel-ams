<?php

namespace Wilgucki\LaravelAms\Models;

use Illuminate\Database\Eloquent\Model;

class AclResource extends Model
{
    protected $fillable = ['controller', 'action', 'methods'];

    public function roles()
    {
        return $this->belongsToMany('Wilgucki\LaravelAms\Models\Role');
    }

    public static function toTree()
    {
        $resources = AclResource::all();
        $acl = [];
        foreach ($resources as $resource) {
            if (!isset($acl[$resource->controller])) {
                $acl[$resource->controller] = [];
            }
            $acl[$resource->controller][$resource->id] = $resource->action;
        }
        return $acl;
    }
}
