<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BajoStockNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $productos; // Variable para almacenar los productos

    // Constructor que acepta una colección de productos
    public function __construct($productos)
    {
        $this->productos = $productos;
    }

    // Método para construir el correo
    public function build()
    {
        return $this->subject('Notificación de Bajo Stock')
                    ->view('emails.bajo_stock'); // Asegúrate de que la vista existe
    }
}
