<?php

namespace App\Enums;

enum Jurusan: string
{
    case PPLG = 'pplg';
    case ELEKTRO = 'elektro';
    case BP = 'bp';
    case TKJ = 'tkj';
    case MESIN = 'mesin';
    case OTOMOTIF = 'otomotif';
    case TEKSTIL = 'tekstil';

    public function getLabel(): string
    {
        return match ($this) {
            self::PPLG => 'PPLG (Pengembangan Perangkat Lunak dan Gim)',
            self::ELEKTRO => 'Teknik Elektro',
            self::BP => 'BP (Broadcasting dan Perfilman)', 
            self::TKJ => 'Teknik Komputer dan Jaringan)',
            self::MESIN => 'Teknik Mesin',
            self::OTOMOTIF => 'Teknik Otomotif',
            self::TEKSTIL => 'Teknik Tekstil',
        };
    }
}
