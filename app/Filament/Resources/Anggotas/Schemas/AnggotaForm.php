<?php

namespace App\Filament\Resources\Anggotas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Enums\Jurusan;

class AnggotaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Dropdown pilih akun User yang mana yang mau dihubungkan ke data
                // Anggota ini. ->relationship('user', 'name') artinya: ambil data
                // dari relasi user() yang sudah kita buat di Model Anggota, dan
                // tampilkan kolom 'name' punya User sebagai label pilihannya.
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Akun User')
                    ->searchable()   // bisa diketik buat nyari, bukan scroll manual
                    ->preload()      // load daftar user di awal, biar pencarian lebih responsif
                    ->required(),

                TextInput::make('nis')
                    ->label('NIS')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('kelas')
                    ->required()
                    ->maxLength(255),

                Select::make('jurusan')
                    ->options(Jurusan::class)
                    ->native(false)
                    ->required(),


                // Diubah dari TextInput (bebas ketik apa saja) jadi Select
                // (pilihan tetap) -- supaya data posisi konsisten dan gampang
                // difilter/dilaporkan nanti (tidak ada "PG" vs "pg" vs "Point Guard"
                // yang beda-beda ketikan tiap Admin input data).
                Select::make('posisi')
                    ->label('Posisi')
                    ->options([
                        'PG' => 'Point Guard (PG)',
                        'SG' => 'Shooting Guard (SG)',
                        'SF' => 'Small Forward (SF)',
                        'PF' => 'Power Forward (PF)',
                        'C'  => 'Center (C)',
                    ])
                    ->native(false) // pakai dropdown custom Filament, bukan dropdown bawaan browser
                    ->default(null),

                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->default('aktif')
                    ->native(false)
                    ->required(),

                DatePicker::make('tanggal_bergabung')
                    ->label('Tanggal Bergabung')
                    ->required()
                    ->default(now()), // default-nya hari ini, Admin tinggal ubah kalau beda
            ]);
    }
}