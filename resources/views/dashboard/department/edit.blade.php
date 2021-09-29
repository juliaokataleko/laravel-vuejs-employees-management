@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Edit Department ({{ $department->name }})</h5>
        <a href="{{ route('departments.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">
        <form action="{{ route('departments.update', $department->id) }}" method="post">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ old('name') ?? $department->name }}" id="name" name="name">
                    </div>
                </div>

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
