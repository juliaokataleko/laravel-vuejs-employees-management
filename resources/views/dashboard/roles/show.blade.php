@extends('layouts.main')

@section('content')
@can('show roles')
<div class="card">
    <div class="card-header d-flex flex-direction-row justify-content-between align-items-center">
        <h3>Role Details</h3>
        @can('add roles')
        <div class="col-sm-6">
            <a class="btn btn-outline-secondary float-right" href="{{ route('roles.index') }}">
                Back
            </a>
        </div>
        @endcan
    </div>
    <div class="card-body">
        @include('dashboard.roles.show_fields')
    </div>
</div>


@endcan
@endsection