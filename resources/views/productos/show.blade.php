@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-10">
            <h1>{{ $producto->nombre }}</h1>
        </div>
        <div class="col-2">
            <a href="{{ url()->previous() }}" class="btn btn-secondary w-100"><i class="bi bi-caret-left mr-2"></i>Volver</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">

            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($producto->fotografias as $key => $fotografia)
                        <div class="carousel-item {{$key == 0 ? 'active' : '' }} ">
                            <img src="/storage/{{$fotografia->imagen}}" class="d-block w-100" alt="{{ $producto->nombre }}">
                        </div>
                    @endforeach
                   
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <h2>Descripción del producto</h2>
            <p class="text-justify">{{ $producto->descripcion }}</p>
            <p class="h4 text-success font-weight-bold">Precio: Q.{{ number_format($producto->precio, 2) }}</p>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-success btn-block"><i class="bi bi-whatsapp mr-2"></i>Información</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary btn-block"><i class="bi bi-bag-plus mr-2"></i>Añadir</button>
                </div>
            </div>
        </div>
    </div>
   
@endsection 
@section('scripts')

@endsection