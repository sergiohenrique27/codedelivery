@extends('app')

@section('htmlheader_title')
    Nextinn - Funcionários
@endsection
@section('contentheader_title')
    Lista de Funcionários
@endsection


@section('main-content')

    @include('errors.msgs')

    <a href="{{ route('admin.employees.create') }}" class="btn btn-success">Novo Funcionário</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name}}</td>
                <td>{{ $employee->email }}</td>
                <td><a href="{{ route('admin.employees.edit', $employee->user_id) }}"
                       class="btn btn-primary btn-sm">Editar</a>
                   <!-- <a href="{{ route('admin.categories.edit', $employee->user_id) }}"
                       class="btn btn-danger btn-sm">Excluir</a> -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection