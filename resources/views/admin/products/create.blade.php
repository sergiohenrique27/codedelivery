@extends('app')

@section('htmlheader_title')
    Admin - Produtos
@endsection
@section('contentheader_title')
     Novo Produto
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'admin.products.store']) !!}

    @include('admin.products._form')

    <div class="form-group">
        {!! Form::submit('Criar Produto', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection