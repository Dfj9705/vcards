<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $cotizaciones = DB::table('cotizaciones')
        // ->select('productos.nombre', DB::raw('count(*) as total'))
        // ->join('productos','producto_id','productos.id')
        // ->groupBy('producto_id')
        // ->orderBy('total','desc')
        // ->get();

        $cotizaciones = Cotizacion::select('producto_id', DB::raw('count(*) as total'))->groupBy('producto_id')->orderBy('total','desc')->limit(3)->get();
        return view('home', compact('cotizaciones'));
    }
}
