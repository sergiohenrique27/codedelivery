@extends('app')

@section('htmlheader_title')
    Admin - Categorias
@endsection
@section('contentheader_title')
     Editando Categoria
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::model($user, ['route'=> ['admin.employees.update', $user->id], 'method' => 'put' ]) !!}

    @include('admin.employees._form')

    <div class="form-group">
        {!! Form::submit('Salvar Funcionário', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection