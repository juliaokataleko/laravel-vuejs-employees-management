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
