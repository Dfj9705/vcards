<?php

namespace App\Http\Controllers;

use App\Producto;
use App\TipoProducto;
use App\ProductoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Producto::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('viewAny');
        $productos = Producto::all();

        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = TipoProducto::all(['id','nombre']);
        return view('productos.create' , compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = request()->validate([
            'nombre' => 'required|min:6',
            'tipo' => 'required',
            'precio' => 'required|numeric|min:1|not_in:0',
            'descripcion' => 'required',
            'fotografias' => 'required',
            
        ]);
      
        if($request->hasFile('fotografias'))
        {
            $allowedfileExtension=['jpeg','jpg','png'];
            $files = $request->file('fotografias');

            foreach($files as $file)
            {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
            }

            if($check)
            {
                // dd($data);
                $productos = Producto::create([
                    'nombre' => $data['nombre'],
                    'descripcion' => $data['descripcion'],
                    'precio' => $data['precio'],
                    'tipo_id' => $data['tipo'],
                ]);

                foreach ($request->fotografias as $fotografia) {
                    $filename = $fotografia->store('fotografias','public');

                    $img = Image::make( public_path("storage/{$filename}") )->fit(750,750);
                    $img->save();
                    ProductoDetalle::create([
                        'producto_id' => $productos->id,
                        'imagen' => $filename
                    ]);
                }
                return redirect()->action('ProductoController@index')->with(['message' => 'Producto guardado', 'alert' => 'alert-success' , 'icon' => 'check-circle']);
            }else{
                return redirect()->action('ProductoController@index')->with(['message' => 'Archivo no aceptado', 'alert' => 'alert-danger' , 'icon' => 'info-circle']);

            }
        }else{
            return redirect()->action('ProductoController@index')->with(['message' => 'Debe subir al menos una fotografia', 'alert' => 'alert-danger' , 'icon' => 'info-circle']);

        }

        




        // return redirect()->;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    { 
      
        return view('productos.show', compact( 'producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $tipos = TipoProducto::all(['id','nombre']);
        $fotografias = ProductoDetalle::where('producto_id' , $producto->id)->get();
        return view('productos.edit', compact('tipos', 'producto', 'fotografias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $data = request()->validate([
            'nombre' => 'required|min:6',
            'tipo' => 'required',
            'precio' => 'required|numeric|min:1|not_in:0',
            'descripcion' => 'required',
        ]);

        $producto->nombre = $data['nombre'];
        $producto->tipo_id = $data['tipo'];
        $producto->precio = $data['precio'];
        $producto->descripcion = $data['descripcion'];

        if($request->hasFile('fotografias'))
        {
            $allowedfileExtension=['jpeg','jpg','png'];
            $files = $request->file('fotografias');

            foreach($files as $file)
            {
                $filename = $file->getClientOriginalName();
               
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
            }

            if($check)
            {

                // $productos = Producto::create($request->all());
               

                foreach ($request->fotografias as $fotografia) {
                    $filename = $fotografia->store('fotografias','public');
                    $img = Image::make( public_path("storage/{$filename}") )->fit(750,750);
                    $img->save();
                    ProductoDetalle::create([
                        'producto_id' => $producto->id,
                        'imagen' => $filename
                    ]);
                }
                
            }else{
                return redirect()->action('ProductoController@index')->with(['message' => 'Archivo no aceptado', 'alert' => 'alert-danger' , 'icon' => 'info-circle']);

            }
        }

        $producto->save();
        return redirect()->action('ProductoController@index')->with(['message' => 'Producto modificado', 'alert' => 'alert-success' , 'icon' => 'check-circle']);


        // return redirect()->action('ProductoController@index')->with(['message' => 'Producto modificado', 'alert' => 'alert-success' , 'icon' => 'check-circle']);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        // $producto->delete();
        // return redirect()->action('ProductoController@index');
        foreach ($producto->fotografias as $fotografia) {
           $fotografia->delete();
        } 
        $producto->delete();

        return redirect()->back();
    }

    public function getProductos(Request $request)
    {

        $productos = DB::table('productos')
                        ->join('tipo_productos','productos.tipo_id', '=','tipo_productos.id')
                        ->select('productos.*', 'tipo_productos.nombre as tipo_nombre')
                        ->get();
        return json_encode($productos);
        

        // return "hola";
    }


}
