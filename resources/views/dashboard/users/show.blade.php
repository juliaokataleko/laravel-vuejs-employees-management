@extends('layouts.main')

@section('content')
<div class="card ">
    <div class="card-header  d-sm-flex align-items-center justify-content-between mb-2">
        <h5>{{ $user->full_name }}</h5>
        <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <div class="card-body">
        <h5 class="card-title">{{ $user->email }}</h5>
        <p class="card-text">ID: #{{ $user->id }}</p>
        <a href="#" class="btn btn-primary"><b>Username: </b> {{ $user->username }}</a>
    </div>
</div>
@endsection
