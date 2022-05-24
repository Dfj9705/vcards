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
                @if (count($producto->fotografias) > 1)
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <h2>Descripción del producto</h2>
            <p class="text-justify">{!! $producto->descripcion !!}</p>
            <p class="h4 text-success font-weight-bold">Precio: Q.{{ number_format($producto->precio, 2) }}</p>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-success btn-block"><i class="bi bi-whatsapp mr-2"></i>Información</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary btn-block"  data-toggle="modal" data-target="#showModal"><i class="bi bi-bag-plus mr-2"></i>Cotizar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cotizar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cotizacion.store') }}" method="post" id="formCotizacion">
                    @csrf
                    <input type="hidden" name="producto" value="{{ $producto->id }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <label for="fecha">Fecha de entrega</label>
                            <input type="datetime-local" class="form-control @error('fecha') is-invalid @enderror"" name="fecha" id="fecha" value="{{ old('fecha') }}">
                            @error('fecha')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" value="1" class="form-control @error('cantidad') is-invalid @enderror"" name="cantidad" id="cantidad" value="{{ old('cantidad') }}">
                            @error('cantidad')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="formCotizacion" class="btn btn-primary">Cotizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection 
@section('scripts')
    <script>
        const enviarCotiacion = async e =>{
            e.preventDefault();
         
            const url = "{{ route('cotizacion.store') }}";
            const formdata = new FormData(e.target)

            // console.log(formdata);

            const config = {
                method: 'POST',
                body: formdata
            }
            try {
                const response = await fetch(url, config);
                const data = await response.json();
                
                if(!data.error){
                    Toast.fire({
                        icon: 'success',
                        title: "Cotización generada"
                    })
                    $("#showModal").modal("hide");
                    e.target.reset();
                }else{
                    let texto = '';
                    data.error.forEach(err => {
                        texto += err + '\n'
                    });
                    
                    Toast.fire({
                        icon: 'warning',
                        title: texto
                    })
                }
            } catch (error) {
                console.log(error);
            }
            

        }


        document.querySelector('#formCotizacion').addEventListener('submit', enviarCotiacion)
    </script>

@endsection