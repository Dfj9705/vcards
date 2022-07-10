<div class="row justify-content-lg-around">

    <div class="col-lg-3 mb-4 mb-lg-0 border rounded p-3 bg-light">
        <p class="lead text-muted">Filtros <i class="bi bi-funnel"></i></p>
        <div class="row mb-2">
            
            <div class="col-lg-12">
                <label class="text-muted" for="tipo">Tipo</label>
              
                <select name="tipo" id="tipo" class="form-control" wire:model="tipoId">
                    <option value="">Todos</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row ">
            
            <div class="col-lg-8">
                <label class="text-muted" for="termino">Termino</label>
                <input type="search" name="termino" id="termino" class="form-control" wire:model="termino">
                
            </div>
            <div class="col-lg-4">
                <label class="text-muted" for="limite">Mostrar</label>
                <input type="number" min="1" name="limite" id="limite" class="form-control" wire:model="limit">
                
            </div>

        </div>
    
    
        
    </div>
    <div  class="col-lg-8 border rounded p-3 bg-light"  >
        <div class="row py-2">
            @if (count($productos) > 0)
              
                @foreach ($productos as $producto)
                <div class=" col-lg-4 mb-4">
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
                            <p class="card-title font-weight-bold">{{ $producto->nombre }}</p>
                            <p class="text-success">Q. {{ $producto->precio }}</p>
                            <a href="{{ route('productos.show', ['producto' => $producto->id]) }}" class="btn btn-primary btn-block">Ver</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @if ($limit > count($productos))
                    <div class="col-12 text-center text-muted">
                        <p>No más productos por mostrar</p>

                    </div>
                @endif
            @else
                <div class="col text-center">
                    <p class="text-muted">No se encontraron artículos con los criterios seleccionados</p>
                </div>
            @endif
           
        </div>
        {{-- {{  $productos->links('pagination::bootstrap-4') }} --}}
    </div>
    <div class="row justify-content-center">

    
    </div>
</div>