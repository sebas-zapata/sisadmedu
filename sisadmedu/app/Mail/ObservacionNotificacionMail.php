<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Observacion;

class ObservacionNotificacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $observacion;

    public function __construct(Observacion $observacion)
    {
        $this->observacion = $observacion;
    }

    public function build()
    {
        $estudiante = $this->observacion->estudiante;
        $docente = $this->observacion->docente;

        return $this->subject('Nueva observación registrada para tu acudido')
                    ->view('emails.observacion_notificacion')
                    ->with([
                        'estudiante' => $estudiante,
                        'docente' => $docente,
                        'observacion' => $this->observacion,
                    ]);
    }
}
