<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class TwilioController extends Controller
{

    /**
     * Mensaje de whatsapp
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function message($id)
    {
        $producto = Producto::find($id);
        $telefono = Auth::user()->telefono;
        $sid    = "AC530e39936228448513100f2728d6e1b9"; 
        $token  = "98caf59e4b7bd4210e5aa14d233245f5"; 
        $twilio = new Client($sid, $token); 
        
        $message = $twilio->messages 
                        ->create("whatsapp:+50241683352",
                                array( 
                                    "from" => "whatsapp:+502" . $telefono,       
                                    "body" => "Hola, me interesa el " . $producto->nombre, 
                                ) 
                        ); 

        dd($message->sid);

        // dd($producto->nombre);
    }
}
