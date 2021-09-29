@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">States</h5>
        <form method="GET" action="{{ route('countries.index') }}">
            <div class="form-row align-items-center">
                <div class="col">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Search states">
                </div>
                <div class="col">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('states.create') }}" class="btn btn-primary">New State</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Country</th>
                        <th scope="col">Name</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($states as $state)
                    <tr>
                        <td scope="row">#{{ $state->id }}</th>
                        <td>{{ $state->country->name }}</td>
                        <td>{{ $state->name }}</td>
                        <td>
                            <form action="{{ route('states.destroy', $state->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('states.edit', $state->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

    </div>
    <div class="card-footer">
        {{ $states->links() }}
    </div>
</div>
@endsection
