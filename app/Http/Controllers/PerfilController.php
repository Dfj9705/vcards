<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfil = Auth::user()->perfil;
        return view('perfil.index', compact('perfil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $perfil = Auth::user()->perfil;
        return view('perfil.create', compact('perfil'));
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
            'name' => 'required|min:6',
            'telefono' => 'required|min:8|numeric',            
        ]);


        // dd($request['imagen']);
         //actualizacion de la tabla users

         auth()->user()->name = $data['name'];
         auth()->user()->telefono = $data['telefono'];
         auth()->user()->update();

        if( $request['imagen'] ){
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

            //resize de la img
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            // $array_imagen = ['imagen' => $ruta_imagen];

             //se eliminan variables del arreglo data
            unset($data['telefono']);
            unset($data['name']);

            // dd($array_imagen);
            //actualizacion de la tabla perfil
            Perfil::create([ 
                'user_id' => Auth::user()->id,
                'imagen' => $ruta_imagen
            ]);
        }

       

       


        return redirect()->action('PerfilController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view('perfil.edit',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        $data = request()->validate([
            'name' => 'required|min:6',
            'telefono' => 'required|min:8|numeric',            
        ]);


        // dd($request['imagen']);
         //actualizacion de la tabla users

         auth()->user()->name = $data['name'];
         auth()->user()->telefono = $data['telefono'];
         auth()->user()->update();

        if( $request['imagen'] ){
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');

            //resize de la img
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();

            // $array_imagen = ['imagen' => $ruta_imagen];

             //se eliminan variables del arreglo data
            unset($data['telefono']);
            unset($data['name']);

            // dd($array_imagen);
            //actualizacion de la tabla perfil

            $perfil->imagen = $ruta_imagen;
            $perfil->update();
        }

       

       


        return redirect()->action('PerfilController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
