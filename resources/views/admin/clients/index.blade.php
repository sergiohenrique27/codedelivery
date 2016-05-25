@extends('app')

@section('htmlheader_title')
    Admin - CLientes
@endsection
@section('contentheader_title')
    Lista de Clientes
@endsection


@section('main-content')
    <a href="{{ route('admin.clients.create') }}" class="btn btn-success">Novo Cliente</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->user->name }}</td>
                <td><a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Editar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $clients->render() !!}

@endsection