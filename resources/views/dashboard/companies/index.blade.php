@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Companies</h5>
        <form method="GET" action="{{ route('companies.index') }}">
            <div class="form-row align-items-center">
                <div class="col">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Search companies">
                </div>
                <div class="col">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('companies.create') }}" class="btn btn-primary">New Company</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Price</th>
                        <!-- <th scope="col">City</th>
                        <th scope="col">State</th>
                        <th scope="col">Country</th>
                        <th scope="col">Category</th> -->
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($companies as $company)
                    <tr>
                        <td scope="row">#{{ $company->id }}</th>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->phone }}</td>
                        <td>{{ $company->price }}</td>
                        <!-- <td>{{ $company->city->name ?? '' }}</td>
                        <td>{{ $company->state->name ?? '' }}</td>
                        <td>{{ $company->country->name ?? '' }}</td>
                        <td>{{ $company->category->name ?? '' }}</td> -->
                        <td>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
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
        {{ $companies->links() }}
    </div>
</div>

@endsection