@extends('app')

@section('htmlheader_title')
    Admin - Produtos
@endsection
@section('contentheader_title')
     Editando Produto
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::model($product, ['route'=> ['admin.products.update', $product->id], 'method' => 'put' ]) !!}

    @include('admin.products._form')

    <div class="form-group">
        {!! Form::submit('Salvar Produto', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection