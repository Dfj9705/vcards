@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-10">
        <h1>Nuevo producto</h1>
    </div>
    <div class="col-2">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary w-100"><i class="bi bi-caret-left mr-2"></i>Volver</a>
    </div>
</div>
<div class="row justify-content-center">
    <form method="post" action="{{ route('productos.store') }}" enctype="multipart/form-data" class="col-lg-12 border rounded p-4" autocomplete="off" novalidate>
        @csrf
        <div class="row mb-3">
            <div class="col-lg-4">
                <label for="nombre">Nombre del producto/servicio</label>
                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese el nombre" value="{{ old('nombre') }}">
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-4">
                <label for="tipo">Tipo del producto/servicio</label>
                <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror">
                    <option value="">Seleccione...</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{$tipo->id}}" {{old('tipo') == $tipo->id ? 'selected' : ''}}>{{$tipo->nombre}}</option>
                    @endforeach
                </select>
                @error('tipo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-lg-4">
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror" placeholder="0.00" value="{{ old('precio') }}">
                @error('precio')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- <div class="row  mb-3">
            <div class="col-12">
                <label for="descripcion">Descripción del producto/servicio</label>
                <textarea name="descripcion" id="descripcion " class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div> --}}
        <x-forms.tinymce-editor :descripcion="old('descripcion')"/>
           

        <div class="row  mb-3">
            <div class="col-12">
                <label for="fotografia">Fotografias del producto</label>
                <input type="file" name="fotografias[]" accept=".png,.jpeg,.jpg" multiple class="form-control @error('fotografias') is-invalid @enderror">{{ old('fotografia[]') }}</textarea>
                @error('fotografias')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
       
       
        <div class="row justify-content-end mb-3">
            <div class="col-lg-3">
                <button class="btn btn-primary w-100"><i class="bi bi-save mr-2"></i>Guardar</button>
            </div>
        </div>
    </form>
   
</div>
    
@endsection