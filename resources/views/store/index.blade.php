@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Productos disponibles</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($productos as $producto)
        <div class=" col-lg-3 mr-md-3 mb-3">
            <div class="card ">
                <div id="{{ 'carrousel'. $producto->id }}" class="carousel slide mx-0" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($producto->fotografias as $key => $fotografia)
                            <div class="carousel-item {{$key == 0 ? 'active' : '' }} ">
                                <img src="/storage/{{$fotografia->imagen}}" class="d-block w-100" alt="{{ $producto->nombre }}">
                            </div>
                        @endforeach
                       
                    </div>
                    @if (count($producto->fotografias) > 1)
                        <a class="carousel-control-prev" href="{{ '#carrousel'. $producto->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="{{ '#carrousel'. $producto->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                   
                </div>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{ $producto->nombre }}</h5>
                    {{-- <p class="card-text text-justify">{!! $producto->descripcion !!}</p> --}}
                    <a href="{{ route('productos.show', ['producto' => $producto->id]) }}" class="btn btn-primary btn-block">Ver</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $productos->links() }}
@endsection