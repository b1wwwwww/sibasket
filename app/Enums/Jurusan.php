<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Jurusan: string implements HasLabel
{
    // Format: case NAMA_DI_KODE = 'nilai_yang_disimpan_di_database';
    case PPLG = 'pplg';
    case ELEKTRO = 'elektro';
    case BP = 'bp';
    case TKJ = 'tkj';
    case MESIN = 'mesin';
    case OTOMOTIF = 'otomotif';
    case TEKSTIL = 'tekstil';

    // Teks yang dilihat pengguna di layar
    public function getLabel(): string
    {
        return match ($this) {
            self::PPLG => 'PPLG (Pengembangan Perangkat Lunak dan Gim)',
            self::ELEKTRO => 'Teknik Elektro',
            self::BP => 'BP (Broadcasting dan Perfilman)', 
            self::TKJ => 'TKJ (Teknik Komputer dan Jaringan)',
            self::MESIN => 'Teknik Mesin',
            self::OTOMOTIF => 'Teknik Otomotif',
            self::TEKSTIL => 'Teknik Tekstil',
        };
    }
}