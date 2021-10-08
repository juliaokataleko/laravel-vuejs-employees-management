@extends('layouts.main')

@section('content')

<!-- Page Heading -->
<div class="">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <!-- Content Row -->
    <div class="row">

        @role('admin|super_admin')
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Users </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(\App\Models\User::all()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @can('show employees')
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Employers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(\App\Models\Employee::all()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @role('admin|super_admin')
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Departments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count(\App\Models\Department::all()) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

    </div>
</div>

@endsection