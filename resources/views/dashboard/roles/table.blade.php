@can('show roles')
<div class="table-responsive">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Guard Name</th>
                <th colspan="3">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
                <td width="120">

                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('show roles')
                        <a href="{{ route('roles.show', [$role->id]) }}" class='btn btn-success btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        @endcan

                        @can('edit roles')
                        <a href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-primary btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>

                        @endcan
                        @can('delete roles')
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endcan