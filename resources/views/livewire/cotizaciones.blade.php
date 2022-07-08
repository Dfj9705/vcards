<div wire:poll.visible class="modal-body">
    @if (count($cotizaciones) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotizaciones as $llave => $cotizacion)
                   <tr>
                       <td>{{ $llave + 1 }}</td>
                       <td>{{ $cotizacion->producto->nombre }}</td>
                       <td>{{  \Carbon\Carbon::parse($cotizacion->fecha)->format('jS \o\f F, Y g:i:s a')    }}</td>
                       <td>
                        @switch($cotizacion->status)
                            @case(1)
                                Ingresado
                                @break
                            @case(2)
                                Aceptado
                                @break
                            @case(3)
                                Rechazado
                                @break
                            @default
                                
                        @endswitch
                        </td>
                       <td><button onclick='confirmDelete({{ $cotizacion->id }}, "cotizacion")' class="btn btn-sm btn-danger"><i class="bi bi-trash mr-2"></i>Eliminar</button></td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay cotizaciones</p>
    @endif
</div>
