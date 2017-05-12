@extends('app')

@section('htmlheader_title')
    Nextinn - Administradores
@endsection
@section('contentheader_title')
    Lista de Administradores
@endsection

@section('main-content')

    @include('errors.msgs')

    <a href="{{ route('superadmin.admin.create') }}" class="btn btn-success">Novo Administrador</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Hotel</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->name}}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->hotel_name }}</td>
                <td><a href="{{ route('superadmin.admin.edit', $admin->user_id) }}"
                       class="btn btn-primary btn-sm">Editar</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection