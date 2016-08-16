@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Realizar Checkin
@endsection

@section('meta_scripts')


@endsection


@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Clique no campo texto QRCODE e acione o leitor de QRCODE.</h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => 'employee.checkin.show', 'method' => 'post']) !!}

            <div class="form-group">
                {!! Form::label('qrcode', 'QRCODE:' ) !!}
                {!! Form::password('qrcode', null, ['class'=>'form-control' ] ) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Realizar Checkin', ['class'=>'btn btn-primary' ] ) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection