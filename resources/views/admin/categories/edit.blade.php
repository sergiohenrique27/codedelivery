@extends('app')

@section('htmlheader_title')
    Admin - Categorias
@endsection
@section('contentheader_title')
     Editando Categoria
@endsection


@section('main-content')

    @include('errors._check')
    
    {!! Form::model($category, ['route'=> ['admin.categories.update', $category->id], 'method' => 'put' ]) !!}

    @include('admin.categories._form')

    <div class="form-group">
        {!! Form::submit('Salvar Categoria', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection