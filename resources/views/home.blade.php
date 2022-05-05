@extends('layouts.app')

@section('content')
    <div class="row text-center justify-content-center mb-3">
        <div class="col-12">
            <img src="{{ asset('images/vclargo.jpeg') }}"  class="w-100" alt="logo vcards">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <a href="{{ route('store.index') }}" class="btn btn-info btn-block">Ver productos</a>
        </div>
        @if (Auth::user()->hasRole('administrador'))
            <div class="col-lg-6">
                <a href="{{ route('store.index') }}" class="btn btn-secondary btn-block">Dashboard</a>
            </div>
        @endif
    </div>
@endsection
