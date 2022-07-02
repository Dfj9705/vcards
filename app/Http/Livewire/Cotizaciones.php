<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Cotizacion;

class Cotizaciones extends Component
{
    public $cotizaciones;
    // public function mount()
    // {
    //     $this->cotizaciones = Auth::user()->cotizaciones;
    // }
    public function render()
    { 
        $this->cotizaciones = Auth::user()->cotizaciones;
        // dd($cotizaciones);
        return view('livewire.cotizaciones', ['cotizaciones' => $this->cotizaciones ]);
    }
}
