@extends('layouts.app')
@section('title', 'Editar função')
@section('content')
    @can('all role')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Editar função</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('adminlte-templates::common.errors')

            <div class="card">

                {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}
    
                <div class="card-body">
                    <div class="row">
                        @include('admin.roles.fields')
                    </div>
                    <div>
                        @foreach ($permissions as $permission)
                            <label class="p-1 rounded border" for="permission-{{ $permission->id }}">
                            <input type="checkbox" name="permissions[]" multiple 
                                value="{{ $permission->id }}" 
                                @if($role->hasPermissionTo($permission->name)) {{ 'checked' }} @endif
                                id="permission-{{ $permission->id }}">
                                {{ $permission->name }}</label> <br>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('roles.index') }}" class="btn btn-default">Cancelar</a>
                </div>

            {!! Form::close() !!}

            </div>
        </div>
    @endcan
@endsection
