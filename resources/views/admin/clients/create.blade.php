@extends('app')

@section('htmlheader_title')
    Admin - Clientes
@endsection
@section('contentheader_title')
     Novo Cliente
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'admin.clients.store']) !!}

    @include('admin.clients._form')

    <div class="form-group">
        {!! Form::submit('Criar Cliente', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection