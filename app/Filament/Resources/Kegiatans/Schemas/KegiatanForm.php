<?php

namespace App\Filament\Resources\Kegiatans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KegiatanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255),

                Textarea::make('deskripsi')
                    ->default(null)
                    ->columnSpanFull() // textarea makan lebar penuh, bukan sejajar kolom lain
                    ->rows(4),

                DateTimePicker::make('tanggal')
                    ->label('Tanggal & Jam')
                    ->required()
                    ->native(false)   // pakai date/time picker custom Filament, lebih enak dipakai
                    ->seconds(false), // sembunyikan input detik, nggak perlu presisi sampai detik

                TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),

                // kuota nullable = tanpa batas. ->helperText() kasih tau Admin
                // langsung di form, tanpa perlu nebak-nebak/baca dokumentasi lain.
                TextInput::make('kuota')
                    ->numeric()
                    ->minValue(1)
                    ->default(null)
                    ->helperText('Kosongkan jika kegiatan ini tidak dibatasi kuota.'),

                // Urutan pilihan sengaja mengikuti alur bisnis (draft -> published ->
                // ongoing -> completed), bukan alfabetis -- supaya Admin milihnya
                // sesuai tahapan yang wajar, "cancelled" ditaruh paling akhir karena
                // itu status "keluar jalur" (bisa terjadi dari status manapun).
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('draft')
                    ->native(false)
                    ->required()
                    ->helperText('Hanya status "Published" yang tampil di halaman publik dan bisa menerima pendaftaran.'),
            ]);
    }
}