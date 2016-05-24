@extends('app')

@section('htmlheader_title')
    Admin - Categorias
@endsection
@section('contentheader_title')
    Lista de Categorias
@endsection


@section('main-content')
    <a href="#" class="btn btn-success">Nova Categoria</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        </thead>


        <tbody>

        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><a href="#" class="btn btn-primary">Editar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $categories->render() !!}




@endsection