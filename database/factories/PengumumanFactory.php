<?php

namespace Database\Factories;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengumuman>
 */
class PengumumanFactory extends Factory
{
    protected $model = Pengumuman::class;

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(4),
            'isi' => $this->faker->paragraph(4),
            'tanggal_publish' => now(),
            'status' => 'published',
            'kategori' => $this->faker->randomElement(['umum', 'latihan', 'turnamen', 'pengumuman']),
            'foto' => null,
            'is_pinned' => false,
            'scheduled_at' => null,
        ];
    }
}
