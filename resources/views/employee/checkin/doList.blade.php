@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Checkin - Localizar
@endsection


@section('main-content')
    <a href="{{ route('employee.checkin.find') }}" class="btn btn-success">Voltar</a>

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Data Checkin</th>
            <th>Hospedes</th>
            <th>Status</th>
            <th>Ação</th>
        </tr>
        </thead>

        <tbody>
        @foreach($checkins as $checkin)
            <tr>
                <td>#{{ $checkin->id }}</td>
                <td>{{ $checkin->checkin }}</td>
                <td>
                    <ul>
                        @foreach($checkin->guests as $guest)
                            <li>{{$guest->fullname}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    {{ $checkin->status }}
                </td>
                <td><a href="{{ route('employee.checkin.showList', $checkin->id) }}" class="btn btn-primary btn-sm">Ver</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $checkins->render() !!}

@endsection