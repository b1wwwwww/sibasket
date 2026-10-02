<?php

namespace Database\Factories;

use App\Enums\Jurusan;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Anggota>
 */
class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),  // Otomatis bikin User baru setiap kali
            'nis' => $this->faker->unique()->numerify('####'),  // 4 digit random, unique
            'nama' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['X', 'XI', 'XII']) . ' ' . $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'jurusan' => $this->faker->randomElement(Jurusan::cases()),
            'posisi' => $this->faker->randomElement(['PG', 'SG', 'SF', 'PF', 'C', null]),
            'status' => 'aktif',
            'tanggal_bergabung' => $this->faker->dateTimeBetween('-6 months'),
        ];
    }
}
