@extends('layouts.app')
@section('content')
    <h1>Detalle del producto</h1>
    {{ $producto->tipo->nombre }}
    {{ $fotografias }}
@endsection 