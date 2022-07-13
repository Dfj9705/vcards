@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center justify-content-center mb-3">
        <div class="col-12">
            <h1>Bienvenido a Vcards</h1>
        </div>
    </div>
  
    <div class="row">
        <div class="col-12">
            <h2>Nuestros productos más cotizados</h2>
        </div>
        <div  class="col-lg-13 border rounded p-3 bg-light"  >
            <div class="row py-2">
                @if (count($cotizaciones) > 0)
                  
                    @foreach ($cotizaciones as $cotizacion)
                    <div class=" col-lg-4 mb-4">
                        <div class="card ">
                            <div id="{{ 'carrousel'. $cotizacion->producto->id }}" class="carousel slide mx-0" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($cotizacion->producto->fotografias as $key => $fotografia)
                                        <div class="carousel-item {{$key == 0 ? 'active' : '' }} ">
                                            <img src="/storage/{{$fotografia->imagen}}" class="d-block w-100" alt="{{ $cotizacion->producto->nombre }}">
                                        </div>
                                    @endforeach
                                
                                </div>
                                @if (count($cotizacion->producto->fotografias) > 1)
                                    <a class="carousel-control-prev" href="{{ '#carrousel'. $cotizacion->producto->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="{{ '#carrousel'. $cotizacion->producto->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @endif
                            
                            </div>
                            <div class="card-body">
                                <p class="card-title font-weight-bold">{{ $cotizacion->producto->nombre }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                @else
                    <div class="col text-center">
                        <p class="text-muted">No se encontraron artículos con los criterios seleccionados</p>
                    </div>
                @endif
               
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <a href="{{ route('store.index') }}" class="btn btn-primary w-100">Ir a tienda</a href="{{ route('store.index') }}">
                </div>
            </div>
            {{-- {{  $productos->links('pagination::bootstrap-4') }} --}}
        </div>
    </div>
</div>
@endsection
