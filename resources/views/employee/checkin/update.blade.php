@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Checkin - Alteração
@endsection

@section('meta_scripts')

@endsection

@section('main-content')

    @include('errors._check')

    {!! Form::model($checkinAux, ['route'=> ['employee.checkin.store', $checkinAux->id], 'method' => 'put' ]) !!}

    <div class="form-group">
        {!! Form::label('arrivingFrom', 'Origem:' ) !!}
        {!! Form::text('arrivingFrom', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('nextDestination', 'Destino:' ) !!}
        {!! Form::text('nextDestination', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('purposeOfTrip', 'Propósito da Viagem:' ) !!}
        {!!  Form::select('purposeOfTrip', $purposeOfTrip , null , ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('ArrivingBy', 'Meio de Transporte:' ) !!}
        {!!  Form::select('ArrivingBy', $ArrivingBy , null , ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('carPlate', 'Placa do Veículo:' ) !!}
        {!! Form::text('carPlate', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('checkin', 'Data do Checkin:' ) !!}
        {!! Form::input('text', 'checkin', null, ['class'=>'form-control' ] ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('checkout', 'Data do Checkout:' ) !!}
        {!! Form::input('text', 'checkout', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('record', 'Registro:' ) !!}
        {!! Form::textarea('record', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Alterar Checkin', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}

@endsection