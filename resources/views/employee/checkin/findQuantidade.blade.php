@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin - Quantidade
@endsection
@section('contentheader_title')
    Quantidade de Checkins
@endsection

@section('meta_scripts')

@endsection

@section('main-content')

    {!! Form::open(['route' => 'employee.checkin.getQuantidade', 'method' => 'post']) !!}

    <div class="form-group">
        {!! Form::label('inicio', 'Data de Início:' ) !!}
        <br/>
        <input type="date" name="inicio" required>

    </div>

    <div class="form-group">
        {!! Form::label('fim', 'Data Final:' ) !!}
        <br/>
        <input type="date" name="fim" required>
    </div>

    <div class="form-group">
        {!! Form::reset('Limpar Pesquisa', ['class'=>'btn btn-primary' ] ) !!}
        {!! Form::submit('Pesquisar', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}

@endsection