<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Cotizacion;

class CotizacionStatus extends Mailable
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

      /**
     * Create a new message instance.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return void
     */
    public function __construct(Cotizacion $cotizacion)
    {
        $this->cotizacion = $cotizacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('vcards@vcards.com', 'Vcards')->subject($this->cotizacion->status == 2 ? "Evento aceptado" : "Evento Rechazado")
                    ->view('emails.cotizaciones.status')->with(["cotizacion" => $this->cotizacion]);
       
    }
}
