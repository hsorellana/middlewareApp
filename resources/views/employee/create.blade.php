@extends('welcome')

@section('content')
{{ Form::open(['route' => 'employee.store']) }}
  {{ Form::text('name', null, ['placeholder' => 'Nombre']) }}
  {{ Form::text('rut', null, ['placeholder' => 'Rut']) }}
  {{ Form::select('type', ['jefe' => 'jefe', 'bodeguero' => 'bodeguero'], null, ['placeholder' => 'Tipo']) }}
  <button type="submit">Ingresar</button>
{{ Form::close() }}
@endsection