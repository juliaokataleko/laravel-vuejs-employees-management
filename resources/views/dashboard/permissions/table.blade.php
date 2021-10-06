<div class="table-responsive">
    <table class="table table-striped" id="permissions-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Guard name</th>
                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td width="120">

                        {!! Form::open(['route' => ['permissions.destroy', $permission->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            @can('show permissions')
                                <a href="{{ route('permissions.show', [$permission->id]) }}" class='btn btn-secondary btn-xs'>
                                    <i class="far fa-eye"></i>
                                </a>
                            @endcan

                            @can('edit permissions')
                                <a href="{{ route('permissions.edit', [$permission->id]) }}" class='btn btn-primary btn-xs'>
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan

                            @can('delete permissions')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tens a certeza que queres excluir?')"]) !!}
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
