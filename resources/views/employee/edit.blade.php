@extends('welcome')

@section('content')
{{ Form::model($emp, ['method' => 'PUT', 'route' => ['employee.update', $emp->id]]) }}
  {{ Form::text('name', null, ['placeholder' => 'Nombre']) }}
  {{ Form::text('rut', null, ['placeholder' => 'Rut']) }}
  {{ Form::select('type', ['jefe' => 'jefe', 'bodeguero' => 'bodeguero'], null, ['placeholder' => 'Tipo']) }}
  <button type="submit">Actualizar</button>
{{ Form::close() }}
@endsection