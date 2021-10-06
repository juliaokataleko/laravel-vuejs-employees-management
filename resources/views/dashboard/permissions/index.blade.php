@extends('layouts.main')

@section('content')

<div class="card" style="max-width: 650px; margin: 0 auto;">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">System Permisions</h5>
    </div>
    <div class="card-body">
        @include('dashboard.permissions.table')
    </div>
    <div class="card-footer clearfix float-right">
        <div class="float-right">

        </div>
    </div>
</div>

    @endsection