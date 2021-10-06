@extends('layouts.app')
@section('title', 'Funções do sistema')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Funções do sistema</h1>
                </div>
                
                @can('all role')
                    <div class="col-sm-6">
                        <a class="btn btn-primary float-right"
                        href="{{ route('roles.create') }}">
                            Cadastrar
                        </a>
                    </div>
                @endcan
                
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('admin.roles.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $roles])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

