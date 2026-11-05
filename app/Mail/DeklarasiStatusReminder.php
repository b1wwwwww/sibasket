<?php

namespace App\Mail;

use App\Models\Kegiatan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeklarasiStatusReminder extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public Kegiatan $kegiatan,
        public string $nama
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jangan Lupa! Latihan ' . ucfirst($this->kegiatan->jadwalLatihan->hari) . ' ' . $this->kegiatan->tanggal,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.deklarasi-status-reminder',
            with: [
                'kegiatan' => $this->kegiatan,
                'nama' => $this->nama,
                'webUrl' => config('app.url'),
            ],
        );
    }
}
