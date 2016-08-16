@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Checkin
@endsection

@section('meta_scripts')

@endsection


@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Informações do Checkin</h3>
        </div>
        <div class="panel-body">
            <h4>Hotel <span class="label label-default">{{$checkin->hotel->name}}</span></h4>
            <h4>Última Procedência <span class="label label-default">{{$checkin->arrivingFrom}}</span></h4>
            <h4>Próximo Destino <span class="label label-default">{{$checkin->nextDestination}}</span></h4>
            <h4>Propósito da Viagem <span class="label label-default">{{$checkin->purposeOfTrip}}</span></h4>
            <h4>Meio de Transporte <span class="label label-default">{{$checkin->ArrivingBy}}</span></h4>
            <h4>Placa do Veículo <span class="label label-default">{{$checkin->carPlate}}</span></h4>
            <h4>Data do Checkin <span class="label label-default">{{$checkin->checkin}}</span></h4>
            <h4>Registro <span class="label label-default">{{$checkin->record}}</span></h4>

            <a href="{{ route('employee.checkin.update', [$checkin->id]) }}" class="btn btn-success">Alterar Checkin</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Informações dos Hóspedes</h3>
        </div>
        <div class="panel-body">

            @foreach($checkin->guests as $guest)

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$guest->fullname}}</h3>
                    </div>
                    <div class="panel-body">

                        <h4>Email <span class="label label-default">{{$guest->email}}</span></h4>
                        <h4>Profissão <span class="label label-default">{{$guest->ocupation}}</span></h4>
                        <h4>Nacionalidade <span class="label label-default">{{$guest->nacionality}}</span></h4>
                        <h4>Data de Aniverssário <span class="label label-default">{{$guest->birthdate}}</span></h4>
                        <h4>Sexo <span class="label label-default">{{$guest->sex}}</span></h4>
                        <h4>travelDocIssuingCountry <span
                                    class="label label-default">{{$guest->travelDocIssuingCountry}}</span></h4>
                        <h4>Tipo de Documento <span class="label label-default">{{$guest->travelDocType}}</span></h4>
                        <h4>Número do Documento <span class="label label-default">{{$guest->travelDocNumber}}</span></h4>
                        <h4>CPF <span class="label label-default">{{$guest->CPF}}</span></h4>
                        <h4>Telefone <span class="label label-default">{{$guest->phone}}</span></h4>
                        <h4>Celular <span class="label label-default">{{$guest->cellphone}}</span></h4>
                        <h4>Endereço(Casa) <span class="label label-default">{{$guest->permanentAdress}}</span></h4>
                        <h4>CEP(Casa) <span class="label label-default">{{$guest->permanentZipcode}}</span></h4>
                        <h4>Cidade(Casa) <span class="label label-default">{{$guest->permanentCity}}</span></h4>
                        <h4>Estado <span class="label label-default">{{$guest->state}}</span></h4>
                        <h4>País <span class="label label-default">{{$guest->country}}</span></h4>
                        <h4>Empresa <span class="label label-default">{{$guest->companyName}}</span></h4>
                        <h4>Endereço (Empresa) <span class="label label-default">{{$guest->companyName}}</span></h4>
                        <h4>Endereço (Empresa) <span class="label label-default">{{$guest->companyAdress}}</span></h4>
                        <h4>CEP (Empresa) <span class="label label-default">{{$guest->companyZipcode}}</span></h4>

                        <a href="{{ route('employee.checkin.guest', [$checkin->id, $guest->id]) }}"
                           class="btn btn-success">Alterar Hospede</a>
                    </div>
                </div>

            @endforeach

            <a href="{{ route('employee.checkin.ficha', [$checkin->id]) }}" class="btn btn-success">Imprimir Fichas</a>

            @if ($checkin->status == 'A')
            <a href="{{ route('employee.checkin.updateStatus', [$checkin->id, 'V']) }}" class="btn btn-success">Finalizar
                Checkin</a>
            @endif

            @if ($checkin->status == 'V')
            <a href="{{ route('employee.checkin.updateStatus', [$checkin->id, 'R']) }}" class="btn btn-success">Realizar
                Checkout</a>
            @endif

        </div>
    </div>

@endsection