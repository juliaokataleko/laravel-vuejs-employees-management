<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if(request('search')) {
            $query->where('username', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('first_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%");
        }
        $users = $query->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $this->validateData($request);
        $data['password'] = bcrypt($data['password']);
        User::insertGetId($data);
        return redirect(route('users.index'))->with('success', 'User created successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();

        return view('dashboard.users.edit', compact('roles', 'user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->all();

        if(!is_null($data['password']) AND $data['password'] === $data['password_confirmation']) {
            $data['password'] = bcrypt($data['password']);
        } else unset($data['password']);
        
        if ($request->permissions) {
            $permissions_array = Permission::whereIn('id', $request->permissions)
                ->pluck('name')->toArray();
            $user->syncPermissions($permissions_array);
        }

        // check if is there role_id passed
        if($request->role_id) {
            $role = Role::find($request->role_id);
            if(!is_null($role)) {
                // add role to user
                $user->assignRole($role->name);
            }
        }
        

        $user->update($data);
        return redirect(route('users.index'))->with('success', 'User updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id === auth()->id())
            return redirect(route('users.index'))->with('warning', 'You are deleting your self');

        $user->delete();
        return redirect(route('users.index'))->with('success', 'User deleted successful');
    }

    public function validateData($request)
    {
        $data = $request->validate([
            'username' => 'min:2|required',
            'last_name' => 'min:2|required',
            'first_name' => 'min:2|required',
            'password' => '',
            'email' => 'min:6|required',
        ]);

        return $data;
    }
}
