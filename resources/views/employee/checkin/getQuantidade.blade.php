@extends('app')

@section('htmlheader_title')
    Nextinn - Quantidade de Checkins
@endsection
@section('contentheader_title')
    Quantidade de Checkins
@endsection


@section('main-content')

    <b>Data de Início:</b> {{ $inicio }}  <b>Data Final:</b> {{ $fim }}

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Quantidade</th>
        </tr>
        </thead>

        <tbody>
            <tr>
                <td align="right">{{ $results[0]->qtd }}</td>
            </tr>
        </tbody>
    </table>

@endsection