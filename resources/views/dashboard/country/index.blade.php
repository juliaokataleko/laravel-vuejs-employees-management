@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Countries</h5>
        <form method="GET" action="{{ route('countries.index') }}">
            <div class="form-row align-items-center">
                <div class="col">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Search countries">
                </div>
                <div class="col">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('countries.create') }}" class="btn btn-primary">New Country</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Country Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($countries as $country)
                    <tr>
                        <td scope="row">#{{ $country->id }}</th>
                        <td>{{ $country->country_code }}</td>
                        <td>{{ $country->name }}</td>
                        <td>
                            <form action="{{ route('countries.destroy', $country->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
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
        {{ $countries->links() }}
    </div>
</div>
@endsection
