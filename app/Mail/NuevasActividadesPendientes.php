<?php

namespace App\Mail;

use App\Models\Unidad;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuevasActividadesPendientes extends Mailable
{
    use Queueable, SerializesModels;

    public Unidad $unidad;

    /**
     * Crear una nueva instancia de correo.
     */
    public function __construct(Unidad $unidad)
    {
        $this->unidad = $unidad;
    }

    /**
     * Definir el asunto del correo electrónico.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Aviso: Nuevas actividades asignadas pendientes de verificar',
        );
    }

    /**
     * Definir la plantilla de correo a renderizar.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.nuevas-actividades-pendientes',
        );
    }

    /**
     * Retornar los archivos adjuntos (vacío para notificaciones consolidadas).
     */
    public function attachments(): array
    {
        return [];
    }
}