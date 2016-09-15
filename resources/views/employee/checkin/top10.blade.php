@extends('app')

@section('htmlheader_title')
    Nextinn - TOP 10
@endsection
@section('contentheader_title')
    TOP 10 - Checkins
@endsection


@section('main-content')

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Quantidade</th>
        </tr>
        </thead>

        <tbody>
        @foreach($results as $result)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $result->name }}</td>
                <td>{{ $result->email }}</td>
                <td align="right">{{ $result->qtd }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection