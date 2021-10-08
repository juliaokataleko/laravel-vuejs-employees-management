<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('dashboard.roles.index')
        ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->rules($request);
        $role = Role::create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($role)
            ->log('store');

        return redirect(route('roles.index'))->with('success', 'Role created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        if (empty($role) || is_null($role)) {
            return redirect(route('roles.index'))->with('success', 'Role not found');
        }

        return view('dashboard.roles.show')
        ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        if (empty($role) || is_null($role)) {
            return redirect(route('roles.index'))->with('success', 'Role not found');
        }

        return view('dashboard.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $this->rules($request);

        if (empty($role) || is_null($role)) {
            return redirect(route('roles.index'))->with('success', 'Role not found');
        }

        $permissions_array = Permission::whereIn('id', $request->permissions)
        ->pluck('name')->toArray();

        $role->syncPermissions($permissions_array);

        $role->update($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($role)
            ->log('update');

        return redirect(route('roles.index'))
        ->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if (empty($role) || is_null($role)) {
            return redirect(route('permissions.index'))->with('success', 'Permission not found');
        }

        activity()
            ->causedBy(auth()->user())
            ->performedOn($role)
            ->log('delete');

        $role->delete();

        return redirect(route('roles.index'))
        ->with('success', 'Role deleted');
    }

    public function rules(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'guard_name' => 'required'
        ]);
    }
}
