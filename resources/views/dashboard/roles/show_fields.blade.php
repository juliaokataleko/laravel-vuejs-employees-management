<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nome:') !!}
    <p>{{ $role->name }}</p>
</div>

<!-- Guard Name Field -->
<div class="col-sm-12">
    {!! Form::label('guard_name', 'Nome da guarda:') !!}
    <p>{{ $role->guard_name }}</p>
</div>

