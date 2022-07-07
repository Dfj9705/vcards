@extends('layouts.app')
@section('styles')
@endsection
@section('content')
<div class="row text-center">
    <div class="col">
        <h1>Edición de la cotización</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form method="post" action="{{ route('cotizacion.update',['cotizacion' => $cotizacion->id]) }}" class="col-lg-10 border rounded p-4" autocomplete="off" novalidate>
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-12">
                <label for="fecha">Fecha</label>
                <input type="datetime-local" name="fecha" id="fecha" class="form-control  @error('fecha') is-invalid @enderror" value="{{ $cotizacion->fecha }}">
                @error('fecha')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row justify-content-end mb-3">
            <div class="col-lg-3">
                <button class="btn btn-warning w-100"><i class="bi bi-pencil mr-2"></i>Guardar cambios</button>
            </div>
        </div>
    </form>
</div>

@endsection