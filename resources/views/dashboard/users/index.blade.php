@extends('layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
        <h5 class="h3 mb-0 text-gray-800">Users</h5>
        <form method="GET" action="{{ route('users.index') }}">
            <div class="form-row align-items-center">
                <div class="col">
                    <input type="search" name="search" class="form-control" value="{{ request('search') ?? '' }}" id="inlineFormInput" placeholder="Search users">
                </div>
                <div class="col">
                    <button type="submit" class="btn
                    btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <a href="{{ route('users.create') }}" class="btn btn-primary">New User</a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">#{{ $user->id }}</th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

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
        {{ $users->links() }}
    </div>
</div>
@endsection
