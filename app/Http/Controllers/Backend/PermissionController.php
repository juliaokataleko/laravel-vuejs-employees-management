<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permissions.index', 
            compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.permissions.create');
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
        $permission = $this->permissionRepository->create($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($permission)
            ->log('store');

        return redirect(route('permissions.index'))->with('success', 'Permission created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        if (empty($permission) || is_null($permission)) {
            return redirect(route('permissions.index'))->with('success', 'Permission not found');
        }

        return view('dashboard.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        if (empty($permission) || is_null($permission)) {
            return redirect(route('permissions.index'))->with('success', 'Permission not found');
        }

        return view('dashboard.permissions.edit')->with('permission', $permission);
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
        $permission = Permission::findOrFail($id);
        $data = $this->rules($request);

        if (empty($permission) || is_null($permission)) {
            return redirect(route('permissions.index'))->with('success', 'Permission not found');
        }

        $permission->update($data);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($permission)
            ->log('update');

        return redirect(route('permissions.index'))->with('success', 'Permission updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if (empty($permission) || is_null($permission)) {
            return redirect(route('permissions.index'))->with('success', 'Permission not found');
        }

        activity()
            ->causedBy(auth()->user())
            ->performedOn($permission)
            ->log('delete permission');

        $permission->delete();

        return redirect(route('permissions.index'))->with('success', 'Permission deleted');
    }

    public function rules(Request $request)
    {
        return $request->validate([
            'name' => 'required',
            'guard_name' => 'required'
        ]);
    }
}
