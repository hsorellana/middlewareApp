@extends('welcome')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 text-center padding">
        <div class="panel panel-default">
          <div class="pane-header">
            <div class="caption">
              <h3>Editar empleado con id {{ $emp->id }}</h3>
            </div>
          </div>
          <div class="panel-body">
            {{ Form::model($emp, ['method' => 'PUT', 'route' => ['employee.update', $emp->id]]) }}
              <div class="form-group">
                {{ Form::text('name', null, ['placeholder' => 'Nombre del empleado', 
                  'class' => 'form-control']) }}
                @if($errors->has('name'))
                  <span class="help-block">
                    <strong class="error">
                      {{ $errors->first('name') }}
                    </strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                {{ Form::text('rut', null, ['placeholder' => 'Rut del empleado', 
                  'class' => 'form-control']) }}
                @if($errors->has('rut'))
                  <span class="help-block">
                    <strong class="error">
                      {{ $errors->first('rut') }}
                    </strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                {{ Form::select('type', ['jefe' => 'Jefe', 'bodeguero' => 'Bodeguero'], null, ['placeholder' => 'Seleccione cargo',
                  'class' => 'form-control']) }}
                @if($errors->has('type'))
                  <span class="help-block">
                    <strong class="error">
                      {{ $errors->first('type') }}
                    </strong>
                  </span>
                @endif  
              </div>
              <div class="form-group">
                <button class="btn btn-primary block form-control" type="submit">Actualizar empleado</button>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection