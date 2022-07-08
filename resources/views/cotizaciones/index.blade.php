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
    <div  class="modal fade" id="messageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mensaje personalizado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="formMessage" class="col" method="POST">
                        @csrf
                        <input type="hidden" id="cotizacion" name="cotizacion" value='{{ old('cotizacion') }}'>
                        <div class="row">
                            <div class="col-12">
                                <label for="mensaje">Mensaje</label>
                                <textarea name="mensaje" id="mensaje" cols="30" rows="10" class="form-control  @error('mensaje') is-invalid @enderror" value='{{ old('mensaje') }}'></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formMessage">Enviar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    const form = document.getElementById('formMessage')
    const enviarMensaje = async e => {
        e.preventDefault();
        const url = "{{ route('cotizacion.mensaje') }}";
            const formdata = new FormData(e.target)

            // console.log(formdata);

            const config = {
                method: 'POST',
                body: formdata
            }
            try {
                const response = await fetch(url, config);
                const data = await response.json();
                console.log(data);
                if(!data.error){
                    Toast.fire({
                        icon: 'success',
                        title: "Mensaje enviado"
                    })
                    $("#messageModal").modal("hide");
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

    const limpiarFormulario = (id) => {
        form.reset();
        form.cotizacion.value = id;
    }
   
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
                            case 4:
                                return "Finalizado"
                                break;
                        
                            default:
                                return "Sin status"
                                break;
                        }
                    }
                },
                { 
                    data: 'id',
                    "width" : '40%',
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
                                <button data-toggle='modal' data-target='#messageModal' onclick='limpiarFormulario(${data})' class='btn btn-sm btn-info'><i class='bi bi-envelope-paper mr-2'></i>Mensaje</button>
                                <button onclick='confirmDelete(${data}, "cotizacion")' class='btn btn-sm btn-danger'><i class='bi bi-trash mr-2'></i>Eliminar</button>
                                
                            </div> `
                },

            ],
            paging: true,
            searching: true

           
        });
    }

    buscarProductos();
    form.addEventListener('submit', enviarMensaje);
    

</script>
@endsection
