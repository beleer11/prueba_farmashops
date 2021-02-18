@extends('layouts.app')

@section('content')
@if(Session::has('mensaje'))
    <div class="alert alert-primary" role="alert" aria-label="close">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container">
   <div class="col-md-12 text-right mb-2">
      <a href="{{ url('vehiculos/create') }}" class="btn btn-primary">Vender vehiculo</a>
   </div>
   @if (count($datos) > 0)
    <table class="table table-light table-hover">
        <thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Descripcion</th>
                <th>Nombre del Asesor</th>
                <th>Foto del Asesor</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < count($datos); $i++)
                <tr>
                    <td>{{ ($i + 1) }}</td>
                    <td>{{ $datos[$i]['marca'] }}</td>
                    <td>{{ $datos[$i]['modelo'] }}</td>
                    <td>{{ $datos[$i]['color'] }}</td>
                    <td>{{ $datos[$i]['descripcion'] }}</td>
                    <td>{{ $datos[$i]['nombre_asesor'] }}</td>
                    <td><img src="{{ $datos[$i]['foto'] }}" alt="{{$datos[$i]['nombre_asesor']}}" width="100" height="100"/></td>
                    <td>{{ $datos[$i]['activo'] }}</td>
                    <td class="text-center">
                        <a class="btn btn-info" href="{{ url('/vehiculos/edit/'. $datos[$i]['id']) }}">Editar</a>    
                        <form action="{{ url('/vehiculos/'. $datos[$i]['id']) }}" method="post" style="display:inline">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button class="btn btn-danger" type="submit" onclick="return confirm('¿Desea borrar?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
    @else
    <div class="mb-3">
        <h5>No hay datos para mostrar</h5>
    </div>
    @endif
</div>

@endsection

