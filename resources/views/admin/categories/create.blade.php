@extends('app')

@section('htmlheader_title')
    Admin - Categorias
@endsection
@section('contentheader_title')
     Nova Categoria
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'admin.categories.store']) !!}

    @include('admin.categories._form')

    <div class="form-group">
        {!! Form::submit('Criar Categoria', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection