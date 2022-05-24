<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cotizacion;
use Validator;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'producto' => 'required',
            'fecha' => 'required|after:'.now(),
            'cantidad' => 'required|numeric|min:1|not_in:0',
            
        ]);

        if($validator->passes()){
            $cotizacion = Cotizacion::create([
                'fecha' => $request['fecha'],
                'producto_id' => $request['producto'],
                'cantidad' => $request['cantidad'],
                'user_id' => Auth::user()->id,
            ]);

            return response()->json($cotizacion);

        }

        return response()->json(['error'=>$validator->errors()->all()]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function cotizaciones()
    {
        $cotizaciones = Auth::user()->cotizaciones;

        return $cotizaciones;
    }
}
