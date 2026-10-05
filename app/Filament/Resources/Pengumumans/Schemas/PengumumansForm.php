<?php

namespace App\Filament\Resources\Pengumumans\Schemas;

use Filament\Forms\Components\DataPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor; 
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PengumumansForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                ->required()
                ->maxLength(255),

            // RichEditor = kotak teks dengan toolbar format (bold, italic, bullet list, link, dll)
            // hasilnya disimpan sebagai HTML di database
            // Admin bisa bikin teks lebih terstruktur
            // (misal daftar poin jadwal, bagian yang di-bold).

            RichEditor::make('isi')
                ->required()
                ->columnSpanFull(),

            DatePicker::make('tanggal_publish')
                ->label('Tanggal Publish')
                ->required()
                ->native(false)
                ->default(now()),
            ]);
    }
}
