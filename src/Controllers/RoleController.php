<?php

namespace Wilgucki\LaravelAms\Controllers;

use App\Http\Controllers\Controller;
use Wilgucki\LaravelAms\Models\AclResource;
use Wilgucki\LaravelAms\Models\Role;
use Wilgucki\LaravelAms\Requests\SaveRoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::paginate(20);
        return view('ams::role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('ams::role.form', [
            'model' => null,
            'method' => 'POST',
            'route' => 'ams.role.store',
            'acl' => AclResource::toTree(),
            'user_resources' => [],
            'header' => 'Dodaj'
        ]);
    }

    public function store(SaveRoleRequest $request)
    {
        $role = Role::create($request->all());

        if ($request->has('action')) {
            foreach ($request->get('action') as $resource_id => $x) {
                $role->acl()->attach($resource_id);
            }
        }

        return redirect()->route('ams.role.index')
            ->with('flash_message', 'Role created');
    }

    public function show($id)
    {
        $item = Role::with('acl')->findOrFail($id);
        $user_resources = [];
        foreach ($item->acl as $role_acl) {
            if (!isset($acl[$role_acl->controller])) {
                $user_resources[$role_acl->controller] = [];
            }
            $user_resources[$role_acl->controller][] = $role_acl->action;
        }
        return view('ams::role.show', [
            'item' => $item,
            'user_resources' => $user_resources
        ]);
    }

    public function edit($id)
    {
        $item = Role::with('acl')->findOrFail($id);
        $user_resources = [];
        foreach ($item->acl as $role_acl) {
            $user_resources[] = $role_acl->id;
        }

        return view('ams::role.form', [
            'model' => $item,
            'method' => 'PUT',
            'route' => ['ams.role.update', $item],
            'acl' => AclResource::toTree(),
            'user_resources' => $user_resources,
            'header' => 'Edytuj'
        ]);
    }

    public function update(SaveRoleRequest $request, $id)
    {
        $item = Role::findOrFail($id);
        $item->update($request->all());

        $item->acl()->detach();

        if ($request->has('action')) {
            foreach ($request->get('action') as $resource_id => $x) {
                $item->acl()->attach($resource_id);
            }
        }

        return redirect()->route('ams.role.index')
            ->with('flash_message', 'Role updated');
    }

    public function destroy($id)
    {
        $item = Role::findOrFail($id);
        $item->delete();
        return redirect()->route('ams.role.index')
            ->with('flash_message', 'Role deleted');
    }
}
