@extends('layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <h2 class="mb-4">Cotizaciones</h2>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-12 table-responsive">
            <table id="datatable" class="table table-light table-striped w-100 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Usuario</th>
                        <th>Teléfono</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $cotizaciones}} --}}

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
   
    const buscarProductos = () => {
        new DataTable('#datatable').destroy();
        let table = new DataTable('#datatable', {
            data : {!! $cotizaciones !!},
            columns: [
                { data: 'name' },
                { data: 'telefono' },
                { data: 'nombre' },
                { data: 'cantidad' },
                { 
                    data: 'fecha',
                    "render" : (data) => {
                        let fecha = new Date(data);
                        return fecha.toLocaleDateString() + " " + fecha.toLocaleTimeString()
                    } 
            
                },
                { 
                    data: 'status',
                    "render" : (data) => {
                        switch (data) {
                            case 1:
                                return "Ingresado"
                                break;
                            case 2:
                                return "Autorizado"
                                break;
                            case 3:
                                return "Rechazado"
                                break;
                        
                            default:
                                return "Sin status"
                                break;
                        }
                    }
                },
                { 
                    data: 'id',
                    "width" : '30%',
                    render : (data) => ` 
                            <div class="btn-group" role="group">
                                <form action='cotizaciones/status/${data}' method='POST'>
                                    @csrf
                                    @method('PUT')
                                    <input type='hidden' name='status' value='2'>
                                    <button type='submit' class='btn btn-sm btn-success'><i class='bi bi-check-circle mr-2'></i>Autorizar</button>
                                </form>
                                <form action='cotizaciones/status/${data}'  method='POST'>
                                    @csrf
                                    @method('PUT')
                                    <input type='hidden' name='status' value='3'>
                                    <button type='submit' class='btn btn-sm btn-danger'><i class='bi bi-x-circle mr-2'></i>Denegar</button>
                                </form>
                                <a href='cotizacion/${data}/edit' class='btn btn-sm btn-warning'><i class='bi bi-pencil-square mr-2'></i>Editar</a>
                                <button class='btn btn-sm btn-info'><i class='bi bi-envelope-paper mr-2'></i>Mensaje</button>
                                
                            </div> `
                },

            ],
            paging: true,
            searching: true

           
        });
    }

    buscarProductos();

    

</script>
@endsection
