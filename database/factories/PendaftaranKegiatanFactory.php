<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PendaftaranKegiatan>
 */
class PendaftaranKegiatanFactory extends Factory
{
    protected $model = PendaftaranKegiatan::class;

    public function definition(): array
    {
        return [
            'anggota_id' => Anggota::factory(),
            'kegiatan_id' => Kegiatan::factory(),
            'status' => $this->faker->randomElement(['terdaftar', 'dibatalkan']),
        ];
    }
}
