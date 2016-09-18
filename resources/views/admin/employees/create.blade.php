@extends('app')

@section('htmlheader_title')
    NextInn - Funcionários
@endsection
@section('contentheader_title')
     Novo Funcionário
@endsection


@section('main-content')

    @include('errors._check')

    {!! Form::open(['route'=>'admin.employees.store']) !!}

    @include('admin.employees._form')

    <div class="form-group">
        {!! Form::submit('Adicionar Funcionário', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}
@endsection