@extends('app')

@section('htmlheader_title')
    Admin - Clientes
@endsection
@section('contentheader_title')
     Editando Cliente - {{$client->user->name}}
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::model($client, ['route'=> ['admin.clients.update', $client->id], 'method' => 'put' ]) !!}

    @include('admin.clients._form')

    <div class="form-group">
        {!! Form::submit('Salvar Cliente', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection