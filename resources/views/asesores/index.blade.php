@extends('layouts.app')

@section('content')
<div class="container">
@if (count($datos) > 0)
   <table class="table table-light table-hover">
      <thead class="thead-light">
         <tr>
               <th>No.</th>
               <th>Nombre</th>
               <th>Apellido</th>
               <th>Email</th>
               <th>Foto</th>
         </tr>
      </thead>
      <tbody>
         @for ($i = 0; $i < count($datos); $i++)
            <tr>
               <td>{{ ($i + 1) }}</td>
               <td>{{ $datos[$i]->first_name }}</td>
               <td>{{ $datos[$i]->last_name }}</td>
               <td>{{ $datos[$i]->email }}</td>
               <td><img src="{{ $datos[$i]->avatar }}" alt="{{$datos[$i]->first_name}}" width="100" height="100"/></td>
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
