@extends('layouts.main')

@section('content')

@can('add roles')

<div class="card">

    <div class="card-header">
        <div class="col-sm-12">
            <h3>Register new role</h3>
        </div>
    </div>

    {!! Form::open(['route' => 'roles.store']) !!}

    <div class="card-body">

        <div class="row">
            @include('dashboard.roles.fields')
        </div>

    </div>

    <div class="card-footer">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
    </div>

    {!! Form::close() !!}

</div>

@endcan

@endsection