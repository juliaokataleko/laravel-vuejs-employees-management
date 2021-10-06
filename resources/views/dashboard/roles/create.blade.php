@extends('layouts.app')
@section('title', 'Cadastrar funções do sistema')
@section('content')

    @can('all role')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Cadastrar funções do sistema</h1>
                    </div>
                </div>
            </div>
        </section>

        <div class="content px-3">

            @include('adminlte-templates::common.errors')

            <div class="card">

                {!! Form::open(['route' => 'roles.store']) !!}

                <div class="card-body">

                    <div class="row">
                        @include('admin.roles.fields')
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
