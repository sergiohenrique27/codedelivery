@extends('app')

@section('htmlheader_title')
    Admin - Cumpons
@endsection
@section('contentheader_title')
     Novo Cupom
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'admin.cupoms.store']) !!}

    @include('admin.cupoms._form')

    <div class="form-group">
        {!! Form::submit('Criar Cupom', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection