@extends('app')

@section('htmlheader_title')
    NextInn - Hotéis
@endsection
@section('contentheader_title')
     Novo Hotel
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'superadmin.hotels.store']) !!}

    @include('superadmin.hotels._form')

    <div class="form-group">
        {!! Form::submit('Adicionar Administrador', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection