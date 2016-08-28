@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Checkin - Localizar
@endsection

@section('meta_scripts')

@endsection

@section('main-content')

    @include('errors._check')

    {!! Form::model($checkin, ['route'=> 'employee.checkin.doList', 'method' => 'post' ]) !!}

    <div class="form-group">
        {!! Form::label('CPF', 'CPF:' ) !!}
        {!! Form::text('CPF', null, ['class'=>'form-control' ] ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-mail:' ) !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('status', 'Status:' ) !!} <br/>
        {!! Form::radio('status', 'A', true ) !!}  Agendado
        {!! Form::radio('status', 'V' ) !!}  Vigente
        {!! Form::radio('status', 'R' ) !!}  Realizado
    </div>

    <div class="form-group">
        {!! Form::reset('Limpar Pesquisa', ['class'=>'btn btn-primary' ] ) !!}
        {!! Form::submit('Pesquisar Checkin', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}

@endsection