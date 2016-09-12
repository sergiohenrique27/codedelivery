@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Hóspede - Alteração
@endsection

@section('meta_scripts')

@endsection

@section('main-content')

    @include('errors._check')

    {!! Form::model($guestAux, ['route'=> ['employee.checkin.storeGuest', $idCheckin, $guestAux->id ], 'method' => 'put' ]) !!}

    <div class="form-group">
        {!! Form::label('email', 'E-mail:' ) !!}
        {!! Form::email('email', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('fullname', 'Nome Completo:' ) !!}
        {!! Form::text('fullname', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('ocupation', 'Profissão:' ) !!}
        {!! Form::text('ocupation', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('nacionality', 'Nacionalidade:' ) !!}
        {!! Form::text('nacionality', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('birthdate', 'Data de Aniversário:' ) !!}
        {!! Form::text('birthdate', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('sex', 'Sexo:' ) !!}
        {!! Form::radio('sex', 'M' ) !!} Masculino
        {!! Form::radio('sex', 'F' ) !!} Feminino
    </div>
    <div class="form-group">
        {!! Form::label('travelDocType', 'Tipo de Documento:' ) !!}
        {!! Form::select('travelDocType',  array(
                'RG' => 'RG',
                'CNH' => 'CNH',
                'Identidade Profissional' => 'Identidade Profissional',
                'Passaporte' => 'Passaporte'
             ))
         !!}
    </div>
    <div class="form-group">
        {!! Form::label('travelDocIssuingCountry', 'Emissor do Documento:' ) !!}
        {!! Form::text('travelDocIssuingCountry', null, ['class'=>'form-control' ] ) !!}
    </div>

    <div class="form-group">
        {!! Form::label('travelDocNumber', 'Número do Documento:' ) !!}
        {!! Form::text('travelDocNumber', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('CPF', 'CPF:' ) !!}
        {!! Form::text('CPF', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('phone', 'Telefone fixo:' ) !!}
        {!! Form::text('phone', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('cellphone', 'Celular:' ) !!}
        {!! Form::text('cellphone', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('permanentAdress', 'Endereço:' ) !!}
        {!! Form::text('permanentAdress', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('permanentZipcode', 'CEP:' ) !!}
        {!! Form::text('permanentZipcode', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('permanentCity', 'Cidade:' ) !!}
        {!! Form::text('permanentCity', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('state', 'Estado:' ) !!}
        {!! Form::text('state', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('country', 'País:' ) !!}
        {!! Form::text('country', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('companyName', 'Nome (Empresa):' ) !!}
        {!! Form::text('companyName', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('companyAdress', 'Endereço(Empresa):' ) !!}
        {!! Form::text('companyAdress', null, ['class'=>'form-control' ] ) !!}
    </div>
    <div class="form-group">
        {!! Form::label('companyZipcode', 'CEP (Empresa):' ) !!}
        {!! Form::text('companyZipcode', null, ['class'=>'form-control' ] ) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Salvar Hóspede', ['class'=>'btn btn-primary' ] ) !!}
    </div>

    {!! Form::close() !!}

@endsection