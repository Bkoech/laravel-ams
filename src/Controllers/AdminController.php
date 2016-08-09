<?php

namespace Wilgucki\LaravelAms\Controllers;

use App\Http\Controllers\Controller;
use Wilgucki\LaravelAms\Models\Admin;
use Wilgucki\LaravelAms\Models\Role;
use Wilgucki\LaravelAms\Requests\SaveAdminRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admins = Admin::with('role')->paginate(20);
        return view('ams::admin.index', ['admins' => $admins]);
    }

    public function create()
    {
        return view('ams::admin.form', [
            'model' => null,
            'method' => 'POST',
            'route' => 'ams.admin.store',
            'roles' => Role::forSelect(),
            'header' => 'Dodaj'
        ]);
    }

    public function store(SaveAdminRequest $request)
    {
        Admin::create($request->all());
        return redirect()->route('ams.admin.index')
            ->with('flash_message', 'User created');
    }
    public function show($id)
    {
        $admin = Admin::with('role')->findOrFail($id);
        return view('ams::admin.show', ['admin' => $admin]);
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('ams::admin.form', [
            'model' => $admin,
            'method' => 'PUT',
            'route' => ['ams.admin.update', $admin],
            'roles' => Role::forSelect(),
            'header' => 'Edycja'
        ]);
    }

    public function update(SaveAdminRequest $request, $id)
    {
        Admin::findOrFail($id)->update($request->all());
        return redirect()->route('ams.admin.index')
            ->with('flash_message', 'User updated');
    }

    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('ams.user.index')
            ->with('flash_message', 'User deleted');
    }
}
