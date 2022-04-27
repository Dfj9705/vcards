@extends('layouts.app')
@section('styles')

    {{-- <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
@endsection
@section('content')
    <div class="row">
        <div class="col-10">
            <h2 class="mb-4">Productos ingresados</h2>
        </div>
        <div class="col-2">
            <a href="{{ route('productos.create') }}" class="btn btn-primary w-100"><i class="bi bi-plus-circle mr-2"></i>Nuevo</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="datatable" class="table table-light table-striped w-100 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th>Opciones</th>

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
   
    const buscarProductos = async () => {
        const url = "{{ route( 'productos.list' ) }}"

        const config = { method : 'GET'}

        const response = await fetch(url, config);
        const data = await response.json();
        new DataTable('#datatable').destroy();
        let table = new DataTable('#datatable', {
            data,
            columns: [
                { data: 'nombre' },
                { 
                    data: 'descripcion', 
                    "render" : ( data, type, row, meta ) => data.length > 30 ? data.substr(0,30) + '...' : data.substr(0,30)
                },
                { data: 'tipo_nombre' },
                { 
                    "data": 'precio', 
                    "render": ( data, type, row, meta ) => `Q. ${data}`,
                    "width" : '15%',
                },
                { 
                    "data": "id",
                    "orderable": false,
                    "searchable" : false,
                    "width" : '25%',
                    "render": ( data, type, row, meta ) => {
                        
                        return `
                            <div class="btn-group" role="group">
                                <a href='productos/${data}' class='btn btn-info'><i class='bi bi-file-post mr-2'></i>Ver</a>
                                <a class='btn btn-warning' href='productos/${data}/edit'><i class='bi bi-pencil mr-2'></i>Editar</a>
                                <a class='btn btn-danger' onclick='confirmDelete(${data})'><i class='bi bi-trash mr-2'></i>Eliminar</a>
                            </div>
                        `
                        
                    }
                }
            ],
            paging: false,
            searching: false

           
        });
    }

    buscarProductos();

    

</script>
@endsection
