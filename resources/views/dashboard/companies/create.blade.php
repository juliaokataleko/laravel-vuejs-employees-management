@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Create Company</h5>
        <a href="{{ route('companies.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('companies.store') }}" method="post">
            @csrf
            <div class="row">

                @include('dashboard.companies.form')
   
                <div class="col-12">

                    <div class="float-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

</div>
@endsection