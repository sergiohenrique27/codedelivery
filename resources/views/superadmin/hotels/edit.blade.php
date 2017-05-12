@extends('app')

@section('htmlheader_title')
    Admin - Categorias
@endsection
@section('contentheader_title')
     Editando Categoria
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::model($hotel, ['route'=> ['superadmin.hotels.update', $hotel->id], 'method' => 'put' ]) !!}

    @include('superadmin.hotels._form')

    <div class="form-group">
        {!! Form::submit('Salvar Hotel', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection