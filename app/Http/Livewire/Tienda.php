<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Producto;
use App\TipoProducto;
use Livewire\WithPagination;

class Tienda extends Component
{
    use WithPagination;
    public $productos;
    public $tipos;
    public $tipoId;
    public $termino;
    public $limit;

    public function mount()
    {
        $this->tipos = TipoProducto::all();
        $this->getProductos();
        $this->limit = 10;
       
    }
    
    public function updated()
    {
        $this->getProductos();
    }

    public function getProductos()
    {
        if($this->tipoId != '' || $this->termino != '' || $this->limit != ''){

            $productos = new Producto();

            if($this->tipoId != ''){
                $productos = $productos->where('tipo_id', $this->tipoId);
            }
            if($this->termino != ''){
                $termino = "%". $this->termino ."%";

                // dd($this->termino);
                $productos = $productos->where('nombre', 'like', $termino);
            }
            if($this->limit != ''){
                $productos = $productos->limit($this->limit);
            }
                // dd($productos->get());
                // dd($this->tipoId);
            $this->productos = $productos->get();

            // dd($this->productos);
        }
        else{
            $this->productos = Producto::all();

        }
    }

    public function render()
    {
    
        return view('livewire.tienda',['productos' => $this->productos ]);

        // dd($cotizaciones);
        // return view('livewire.cotizaciones', ['cotizaciones' => $this->cotizaciones ]);
    }


}
