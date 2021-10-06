@extends('layouts.main')

@section('content')

@can('edit permissions')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Editar permissão</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    <div class="card">

        {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'patch']) !!}

        <div class="card-body">
            <div class="row">
                @include('dashboard.permissions.fields')
            </div>
        </div>

        <div class="card-footer">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('permissions.index') }}" class="btn btn-default">Cancelar</a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endcan

@endsection