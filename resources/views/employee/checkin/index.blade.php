@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin / Checkout
@endsection
@section('contentheader_title')
    Realizar Checkin / Checkout
@endsection

@section('meta_scripts')


@endsection


@section('main-content')

    @include('errors.msgs')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Clique no campo texto e acione o leitor de QRCODE.</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'employee.checkin.show', 'method' => 'post']) !!}

            <div class="form-group">

                <div class="input-group">
                    <input type="password" name="qrcode" class="form-control" placeholder="Clique aqui e Faça a leitura pelo LEITOR...">
                    <span class="input-group-btn">
                         <button class="btn btn-default" type="submit">Localizar Checkin!</button>
                     </span>
                </div>

            </div>


            {!! Form::close() !!}
        </div>
    </div>
@endsection