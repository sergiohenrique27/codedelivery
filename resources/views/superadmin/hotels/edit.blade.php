@extends('app')

@section('htmlheader_title')
    Admin - Categorias
@endsection
@section('contentheader_title')
     Editando Categoria
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::model($user, ['route'=> ['superadmin.admin.update', $user->id], 'method' => 'put' ]) !!}

    @include('superadmin.admin._form')

    <div class="form-group">
        {!! Form::submit('Salvar Administrador', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection