<?php

namespace Database\Factories;

use App\Models\Kegiatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kegiatan>
 */
class KegiatanFactory extends Factory
{
    protected $model = Kegiatan::class;

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(),
            'tanggal' => $this->faker->dateTimeBetween('+1 day', '+30 days'),
            'lokasi' => $this->faker->randomElement(['Lapangan Indoor SMK', 'Lapangan Outdoor', 'Gym Sekolah', 'Court A']),
            'kuota' => $this->faker->randomElement([10, 15, 20, null]),  // null = tanpa batas
            'status' => 'published',  // Supaya bisa daftar
        ];
    }
}
