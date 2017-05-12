@extends('app')

@section('htmlheader_title')
    Nextinn - Hotéis
@endsection
@section('contentheader_title')
    Lista de Hotéis
@endsection

@section('main-content')

    @include('errors.msgs')

    <a href="{{ route('superadmin.hotels.create') }}" class="btn btn-success">Novo Hotel</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($hotels as $hotel)
            <tr>
                <td>{{ $hotel->name}}</td>
                <td><a href="{{ route('superadmin.hotels.edit', $hotel->id) }}"
                       class="btn btn-primary btn-sm">Editar</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $hotels->render() }}

@endsection