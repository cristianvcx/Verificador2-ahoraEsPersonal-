<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordRenewalMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $url;
    public string $expirationDateString;

    /**
     * Crea una nueva instancia de correo para renovación de contraseña.
     */
    public function __construct(User $user, string $url, string $expirationDateString)
    {
        $this->user = $user;
        $this->url = $url;
        $this->expirationDateString = $expirationDateString;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Renovación Obligatoria de Contraseña - Intranet CAJBIOBIO',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.password-renewal',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}