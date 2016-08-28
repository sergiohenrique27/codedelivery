<html>
<head>
    <title>NextInn</title>

    <link href="https://fonts.googleapis.com/css?family=Asul" rel="stylesheet">

    <style>


        * {
            background: transparent !important;
            color: #000 !important;
            text-shadow: none !important;
            filter: none !important;
            -ms-filter: none !important;
        }

        @page {
            margin: 0.5cm;
        }

        .page-break {
            page-break-before: always;
        }

        body {
            margin: 0.25cm;
            padding: 0.25cm;
            line-height: 1.4em;
            font-family: 'Asul', sans-serif;
            font-size: 10pt;
        }

        .box {
            padding: 0.25cm;
            width: 20cm;
            border: 2px solid #000000;
        }

        .titulo {
            font-weight: bold;
            font-size: 18pt;
        }

        .tituloCampo {
            font-weight: bold;
            font-size: 12pt;
        }

    </style>


</head>
<body>

@foreach($checkin->guests as $guest)
    <div class="page-break">
        <div class="box">
            <div id="hotel"> {{$checkin->hotel->name}} </div>
            <h1 class="titulo"> Ficha Nacional de Registro de Hospedes</h1>
        </div>
        <div class="box">
            <p><span class="tituloCampo">Nome Completo:</span> {{$guest->fullname}} </p>
            <p><span class="tituloCampo">Profissão:</span> {{$guest->ocupation}}
                <span class="tituloCampo">Nacionalidade:</span> {{$guest->nacionality}}
                <span class="tituloCampo">Data de Nascimento:</span> {{$guest->birthdate}}
                <span class="tituloCampo">Sexo:</span> {{$guest->sex}}</p>

        </div>
        <div class="box">
            <p><span class="tituloCampo">Tipo de Documento</span> {{$guest->travelDocType}}
                <span class="tituloCampo">Número:</span> {{$guest->travelDocNumber}}
                <span class="tituloCampo">País Emissor:</span> {{$guest->travelDocIssuingCountry}}
                <span class="tituloCampo">CPF:</span> {{$guest->CPF}}
                <span class="tituloCampo">Fone:</span> {{$guest->phone}}
                <span class="tituloCampo">Celular:</span> {{$guest->celphone}}</p>
            <p><span class="tituloCampo">Endereço Residencial</span> {{$guest->permanentAdress}}
                <span class="tituloCampo">CEP (casa):</span> {{$guest->permanentZipcode}}
                <span class="tituloCampo">Cidade(Casa):</span> {{$guest->permanentCity}}
                <span class="tituloCampo">Estado:</span> {{$guest->state}}
                <span class="tituloCampo">País:</span> {{$guest->country}}
            </p>
            <p>
                <span class="tituloCampo">Empresa:</span> {{$guest->companyName}}
                <span class="tituloCampo">Endereço (Empresa):</span> {{$guest->companyAdress}}
                <span class="tituloCampo">CEP (Empresa):</span> {{$guest->companyZipcode}}
            </p>
        </div>
        <div class="box">
            <p>
                <span class="tituloCampo">Última procedência:</span> {{$checkin->arrivingFrom}}
                <span class="tituloCampo">Próximo Destino:</span> {{$guest->companyAdress}}
            </p>
            <p>
                <span class="tituloCampo">Propósito da Viagem:</span> {{$checkin->purposeOfTrip}}
                <span class="tituloCampo">Meio de Transporte:</span> {{$checkin->ArrivingBy}}
                <span class="tituloCampo">Placa do Veículo:</span> {{$checkin->carPlate}}
            </p>
            <p><span class="tituloCampo">Data do Checkin:</span> {{$checkin->checkin}}
            <span class="tituloCampo"> Data do Checkout:</span> {{$checkin->checkout}}</p>
        </div>
        <div class="box">
            <p><span class="tituloCampo">Registro:</span> {{$checkin->record}}</p>
        </div>
        <div class="box">
            <p>PARA SUA MAIOR SEGURANÇA E COMODIDADE, POSSUIMOS UM COFRE DENTRO DE CADA APARTAMENTO. SOLICITAMOS QUE
                TODO E QUALQUER OBJETO DE VALOR SEJAM MANTIDOS NO MESMO. </p>
            <p> </p>
            <p> </p>
            <p> </p>
            <p> </p>
            <p>_______________________________________________________<br/>
                <span class="tituloCampo">Assinatura do Hóspede</span></p>
        </div>

    </div>
@endforeach

<SCRIPT LANGUAGE="JavaScript">
    window.print()
</SCRIPT>
</body>
</html>