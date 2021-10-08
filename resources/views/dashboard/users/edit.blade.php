@extends('layouts.main')

@section('content')


<div class="card">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Create user</h5>
        <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('put')
            @include('dashboard.users.form', compact('user'))

            @can('show roles')
            <div class="row m-2 border rounded mt-4 p-3">
                <hr>
                <h4 class="col-12">Permissões</h4>
                @foreach ($permissions as $permission)
                <div class="col-md-3 form-group">
                    <label class="p-1 mr-2 rounded border" for="permission-{{ $permission->id }}">
                        <input type="checkbox" name="permissions[]" multiple value="{{ $permission->id }}" @if($user->hasPermissionTo($permission->name)) {{ 'checked' }} @endif
                        id="permission-{{ $permission->id }}">
                        {{ $permission->name }}</label>
                </div>
                @endforeach
            </div>
            @endcan

            @role('admin|super_admin')
            <div class="row m-2 border rounded mt-4 p-3">
                <label for="role_id">Role</label>
                <select class="form-control" name="role_id" id="role_id">
                    <option value="">Select an option</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @role($role->name) {{ 'selected' }} @endrole
                        >{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            @endrole

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-outline-primary float-right">Save</button>
        </form>
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete {{ $user->username }}</button>
        </form>
    </div>
</div>
</form>



@endsection