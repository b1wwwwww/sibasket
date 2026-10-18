<?php

namespace Database\Factories;

use App\Models\Absensi;
use App\Models\PendaftaranKegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Absensi>
 */
class AbsensiFactory extends Factory
{
    protected $model = Absensi::class;

    public function definition(): array
    {
        return [
            'pendaftaran_id' => PendaftaranKegiatan::factory(),
            'status_kehadiran' => $this->faker->randomElement(['hadir', 'izin', 'sakit', 'alpa']),
            'catatan' => $this->faker->optional(0.3)->sentence(),
        ];
    }

    /**
     * State: Hadir
     */
    public function hadir()
    {
        return $this->state(fn (array $attributes) => [
            'status_kehadiran' => 'hadir',
            'catatan' => null,
        ]);
    }

    /**
     * State: Izin
     */
    public function izin()
    {
        return $this->state(fn (array $attributes) => [
            'status_kehadiran' => 'izin',
            'catatan' => $this->faker->sentence(),
        ]);
    }

    /**
     * State: Alpa
     */
    public function alpa()
    {
        return $this->state(fn (array $attributes) => [
            'status_kehadiran' => 'alpa',
            'catatan' => null,
        ]);
    }
}
