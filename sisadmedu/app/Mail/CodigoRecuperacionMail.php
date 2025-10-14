<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodigoRecuperacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $code;

    public function __construct($usuario, $code)
    {
        $this->usuario = $usuario;
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Código de recuperación de contraseña')
                    ->view('emails.codigo_recuperacion')
                    ->with([
                        'usuario' => $this->usuario,
                        'code' => $this->code,
                    ]);
    }
}
