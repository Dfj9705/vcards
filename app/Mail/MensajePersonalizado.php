<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Cotizacion;

class MensajePersonalizado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * The cotizacion instance.
     *
     * @var \App\Cotizacion
     */
    protected $cotizacion;
    protected $mensaje;

      /**
     * Create a new message instance.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @param  string  $mensaje
     * @return void
     */
    public function __construct(Cotizacion $cotizacion, $mensaje)
    {
        $this->cotizacion = $cotizacion;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('vcards@vcards.com', 'Vcards')->subject("Mensaje de Vcards")
                    ->view('emails.cotizaciones.mensaje')->with(["cotizacion" => $this->cotizacion, "mensaje" => $this->mensaje]);
       
    }
}
