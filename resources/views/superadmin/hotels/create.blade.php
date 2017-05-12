@extends('app')

@section('htmlheader_title')
    NextInn - Administradores
@endsection
@section('contentheader_title')
     Novo Administrador
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'superadmin.admin.store']) !!}

    @include('superadmin.admin._form')

    <div class="form-group">
        {!! Form::submit('Adicionar Administrador', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection