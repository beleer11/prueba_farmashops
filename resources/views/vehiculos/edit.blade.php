@extends('layouts.app')
@section('content')

<div class="container">
        <form action="{{ url('/vehiculos/actualizar/'.$datos->id) }}" method="POST" style="margin:0 auto">
            {{ csrf_field() }}
            {{ method_field('POST') }}

            @include('vehiculos.form', ['modo' => 'editar'])  

        </form>
</div>
@endsection