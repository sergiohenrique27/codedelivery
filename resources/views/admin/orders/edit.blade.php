@extends('app')

@section('htmlheader_title')
    Admin - Pedidos
@endsection
@section('contentheader_title')
    Pedido # {{$order->id}} - R$ {{$order->total}}
@endsection



@section('main-content')
    @include('errors._check')

    <h4>Data: {{$order->created_at}}</h4>

    <h4>Cliente: {{$order->client->user->name}}</h4>
    <p>
        <b>Entregar em:</b> <br>
        {{$order->client->address }} - {{$order->client->city }} - {{$order->client->state }}
    </p>

    {!! Form::model($order, ['route'=> ['admin.orders.update', $order->id], 'method' => 'put' ]) !!}

    <div class="form-group">
        {!! Form::label('Status', 'Status:' ) !!}
        {!! Form::select('status', $list_status, null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Deliveryman', 'Entregador:' ) !!}
        {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class'=>'form-control' ] ) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Salvar Pedido', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}

@endsection