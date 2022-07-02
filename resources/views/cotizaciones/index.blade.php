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
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody >
                </tbody>
            </table>
        </div>
    </div>
    

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
                { data: 'email' },
                { data: 'telefono' },
                { data: 'nombre' },
                { data: 'cantidad' },
                { data: 'fecha' },
                { 
                    data: 'status',
                    "render" : (data) => {
                        switch (data) {
                            case 1:
                                return "Ingresado"
                                break;
                        
                            default:
                                break;
                        }
                    }
                },

            ],
            paging: true,
            searching: true

           
        });
    }

    buscarProductos();

    

</script>
@endsection
