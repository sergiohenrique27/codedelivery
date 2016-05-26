@extends('app')

@section('htmlheader_title')
    Admin - Cumpoms
@endsection
@section('contentheader_title')
    Lista de Cupons
@endsection


@section('main-content')
    <a href="{{ route('admin.cupoms.create') }}" class="btn btn-success">Novo Cupom</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Valor</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($cupoms as $cupom)
            <tr>
                <td>{{ $cupom->id }}</td>
                <td>{{ $cupom->code }}</td>
                <td>{{ $cupom->value }}</td>
                <td><a href="{{ route('admin.cupoms.edit', $cupom->id) }}" class="btn btn-primary btn-sm">Editar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $cupoms->render() !!}

@endsection