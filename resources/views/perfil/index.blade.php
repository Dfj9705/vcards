@extends('layouts.app')
@section('content')

    <div class="row text-center">
        <div class="col">
            <h1>
                Mi perfil
            </h1>
        </div>
    </div>
    <div class="row justify-content-center ">
        <div class="col-10 col-lg-2 mb-4 mb-lg-0">
            @if (isset($perfil->imagen))
                <img src="/storage/{{$perfil->imagen}}" alt="imagen de usuario" class="rounded-circle" width="100%">
            @else
                <img src="{{ asset('images/user.png') }}" alt="imagen de usuario" width="100%">
            @endif
        </div>
        <div class="col-lg-6 border bg-light rounded p-3">
            <div class="row">
                <div class="col">
                    <p><span class="font-weight-bold">Nombre:</span> {{ Auth::user()->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><span class="font-weight-bold">Teléfono:</span> {{ Auth::user()->telefono }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><span class="font-weight-bold">Email:</span> {{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (empty($perfil))
                    
                        <a href="{{ route('perfil.create') }}" class="btn btn-warning w-100"><i class="bi bi-pencil-square mr-2"></i>Editar perfil</a>
                        
                    @else
                        <a href="{{ route('perfil.edit', ['perfil' => $perfil->id ] ) }}" class="btn btn-warning w-100"><i class="bi bi-pencil-square mr-2"></i>Editar perfil</a>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection