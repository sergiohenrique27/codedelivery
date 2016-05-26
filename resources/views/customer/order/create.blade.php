@extends('app')
@section('htmlheader_title')
    Admin - Checkout
@endsection
@section('contentheader_title')
    Checkout
@endsection


@section('main-content')

    @include('errors._check')

    <div class="container">
    {!! Form::open(['route'=>'customer.order.store', 'class' => 'form']) !!}

    <div class="form-group">
        <label>Valor Total:</label>
        <p id="total"></p>
        <a href="#" id="btnNewItem" class="btn btn-default"> Novo item </a>

        <table class="table talbe-bordered">
            <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <select class="form-control" name="items[0][product_id]">
                        @foreach($products as $p)
                            <option value="{{$p->id}}" data-price="{{ $p->price }}"> {{ $p->name }} --- {{ $p->price }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    {!! Form::text('items[0][qtd]', 1, ["class" => "form-control"]) !!}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

        <div class="form-group">
            {!! Form::submit('Criar Pedido', ['class'=>'btn btn-primary' ] ) !!}
        </div>

    {!! Form::close() !!}
    </div>
@endsection

@section('post-script')
    <script>
        $('#btnNewItem').click( function () {
            var row = $('table tbody > tr:last'),
                    newRow = row.clone(),
                    lenght = $('table tbody tr').length;

            newRow.find('td').each(function () {
                var td = $(this),
                        input = td.find('input,select'),
                        name = input.attr('name');
                input.attr('name', name.replace( lenght-1 + "", lenght + "" ))
            });

            newRow.find('input').val(1);
            newRow.insertAfter( row );
            calculateTotal();

        });

        $(document.body).on('blur', 'input', function () {
            calculateTotal();
        });

        $(document.body).on('change', 'select', function () {
            calculateTotal();
        });

        function calculateTotal(){
            var total = 0,
                    trLen = $('table tbody tr').length,
                    tr = null, price, qtd;
            for(var i=0; i < trLen; i++){
                tr = $('table tbody tr').eq( i );
                price = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += price * qtd;
            }
            $('#total').html( total );
        }
    </script>
@endsection