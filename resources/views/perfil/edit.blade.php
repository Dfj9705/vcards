@extends('layouts.app')
@section('content')
<div class="row text-center">
    <div class="col">
        <h1>Editar datos</h1>
    </div>
</div>
<div class="row justify-content-center">
    <form method="POST" enctype="multipart/form-data" action="{{ route('perfil.update', ['perfil' => $perfil->id ]) }}"  class="col-lg-6 border rounded bg-light p-5">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-12">
                <label for="name">Nombre de usuario</label>
                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') ? old('name') : Auth::user()->name  }}">
                @error('name')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="telefono">No. de Teléfono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control  @error('telefono') is-invalid @enderror" value="{{ old('telefono') ? old('telefono') : Auth::user()->telefono  }}">
                @error('telefono')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control-file  @error('imagen') is-invalid @enderror">
                @error('imagen')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if (isset($perfil->imagen))
            <div class="row mb-3">
                <div class="col-12">
                    <p for="">Imagen Actual</p>
                    <img src="/storage/{{$perfil->imagen}}" alt="imagen de usuario" width="150px">
                </div>
            </div>
            
        @endif
        <div class="row mb-3">
            <div class="col-12">
                <button class="btn btn-primary w-100"><i class="bi bi-save mr-2"></i>Guardar</button>
            </div>
        </div>
    </form>
</div>
@endsection