@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
            <h5 class="h3 mb-0 text-gray-800">Create user</h5>
            <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <div class="card-body">
            @include('dashboard.users.form')
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-outline-primary float-right">Save</button>
        </div>
    </div>
</form>
@endsection
