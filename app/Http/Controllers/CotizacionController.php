<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CotizacionStatus;
use App\Cotizacion;
use App\Mail\CotizacionCreate;
use App\Mail\CotizacionEdit;
use Validator;

class CotizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->authorizeResource(Cotizacion::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cotizaciones = DB::table('cotizaciones')
        ->select('fecha', 'cantidad', 'users.name', 'users.email','users.telefono','productos.nombre','cotizaciones.status', 'cotizaciones.id')
        ->join('users','cotizaciones.user_id', '=','users.id')
        ->join('productos','cotizaciones.producto_id','=','productos.id')
        ->orderBy('id', 'desc')
        ->get();

        return view('cotizaciones.index', compact('cotizaciones'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendario()
    {
        $cotizaciones = DB::table('cotizaciones')
        ->select('fecha as date',  'productos.nombre as title', 'cotizaciones.id as id', 'users.name as usuario')
        ->join('users','cotizaciones.user_id', '=','users.id')
        ->join('productos','cotizaciones.producto_id','=','productos.id')
        ->where('status','=','2')
        ->get();

        return view('calendario.index', compact('cotizaciones'));
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
            Mail::to($cotizacion->usuario->email)->send( new CotizacionCreate($cotizacion) );
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
        $cotizacion = Cotizacion::find($id);
        return view('cotizaciones.edit', compact('cotizacion'));
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
        $data = request()->validate([
            'fecha' => 'required|after:'.now(),
        ]);
        $cotizacion = Cotizacion::find($id);
        $cotizacion->fecha = $data['fecha'];
        $cotizacion->save();
        Mail::to($cotizacion->usuario->email)->send( new CotizacionEdit($cotizacion) );
        return redirect()->action('CotizacionController@index')->with(['message' => 'Cotización modificada', 'alert' => 'alert-success' , 'icon' => 'check-circle']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $data = request()->validate([
            'status' => 'required',
        ]);

        $cotizacion = Cotizacion::find($id);

        
        $cotizacion->status = $data['status'];
        $cotizacion->save();
        Mail::to($cotizacion->usuario->email)->send( new CotizacionStatus($cotizacion) );
        return redirect()->action('CotizacionController@index')->with(['message' => 'Status Modificado', 'alert' => 'alert-success' , 'icon' => 'check-circle']);
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
