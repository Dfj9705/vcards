<div wire:poll.visible class="modal-body">
    @if (count($cotizaciones) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cotizaciones as $llave => $cotizacion)
                   <tr>
                       <td>{{ $llave + 1 }}</td>
                       <td>{{ $cotizacion->producto->nombre }}</td>
                       <td>{{  \Carbon\Carbon::parse($cotizacion->fecha)->format('jS \o\f F, Y g:i:s a')    }}</td>
                   </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay cotizaciones</p>
    @endif
</div>
