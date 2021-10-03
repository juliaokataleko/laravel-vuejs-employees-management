@extends('layouts.main')

@section('content')
<div class="">
    <div class="">
        <div class="">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Registo de Atividades
                    <a href="{{ route('home') }}" class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Voltar</a>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Log</th>
                                <th>Descrição</th>
                                <th>Tabela</th>
                                <th>Tabela ID</th>
                                <!-- <th>causer_type</th> -->
                                <th>Usuário</th>
                                <th>Provedor</th>
                                <th>Hora</th>
                                <th>Excluir</th>
                            </thead>
                            <tbody>
                                @foreach($activities as $act)
                                <tr>
                                    <td>{{ $act->id }}</td>
                                    <td>{{ $act->log_name }}</td>
                                    <td>{{ $act->description }}</td>
                                    <td>{{ $act->subject_type }}</td>
                                    <td>{{ $act->subject_id }}</td>
                                    <td>{{ $act->causer->name ?? '' }}</td>
                                    <td>{{ $act->company->name ?? 'Super Admin' }}</td>
                                    <td>{{ $act->created_at }}</td>
                                    <td width="120">

                                        <form action="{{ route('activities.destroy', $act->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class='btn-group'>
                                                <button type="submit" class="btn-xs btn btn-danger" onclick="return confirm('Tens a certeza?')">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <h4>
                        {{ auth()->user()->level }}
                    </h4>
                    <div>
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection