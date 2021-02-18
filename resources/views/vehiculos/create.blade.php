@extends('layouts.app')
@section('content')

<div class="container">
    <form action="{{ url('/vehiculos/guardar') }}" method="POST" style="margin:0 auto">
        {{ csrf_field() }}

        @include('vehiculos.form', ['modo' => 'crear'])   

    </form>
</div>
@endsection