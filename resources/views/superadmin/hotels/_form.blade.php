<div class="form-group">
    {!! Form::label('Name', 'Nome:' ) !!}
    {!! Form::text('name', null, ['class'=>'form-control' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('Email', 'Email:' ) !!}
    {!! Form::email('email', null, ['class'=>'form-control' ] ) !!}
</div>
<div class="form-group">
    {!! Form::label('Hotel', 'Hotel:' ) !!}
    {!! Form::select('hotel_id', $hoteis, null, ['class'=>'form-control' ] ) !!}
</div>