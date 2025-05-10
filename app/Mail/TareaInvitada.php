<?php

namespace App\Mail;

use App\Models\Tarea;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TareaInvitada extends Mailable
{
    use Queueable, SerializesModels;

    public $tarea;
    public $invitador;

    /**
     * Create a new message instance.
     */
    public function __construct(Tarea $tarea, User $invitador)
    {
        $this->tarea = $tarea;
        $this->invitador = $invitador;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Has sido invitado a la tarea: ' . $this->tarea->titulo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.tarea_invitada',
            with: [
                'tareaNombre' => $this->tarea->titulo,
                'invitadorNombre' => $this->invitador->name,
                'tareaDescripcion' => $this->tarea->descripcion,
                'tareaFechaVencimiento' => $this->tarea->fecha_vencimiento ? $this->tarea->fecha_vencimiento->format('Y-m-d') : 'Sin fecha de vencimiento',
                'tareaUrl' => route('tareas.show', $this->tarea->id), // O la URL que desees
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}