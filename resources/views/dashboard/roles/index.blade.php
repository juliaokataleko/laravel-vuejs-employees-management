@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header d-flex flex-direction-row justify-content-between align-items-center">
        <h3>System Roles</h3>
        @can('add roles')
        <div class="col-sm-6">
            <a class="btn btn-primary float-right" href="{{ route('roles.create') }}">
                Add
            </a>
        </div>
        @endcan
    </div>
    <div class="card-body">
        @include('dashboard.roles.table')
    </div>
</div>

@endsection