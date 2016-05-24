@extends('app')

@section('htmlheader_title')
    Admin - Produtos
@endsection
@section('contentheader_title')
    Lista de Produtos
@endsection


@section('main-content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">Novo Produto</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <a href="{{ route('admin.products.destroy', $product->id) }}" class="btn btn-danger btn-sm">Apagar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $products->render() !!}

@endsection