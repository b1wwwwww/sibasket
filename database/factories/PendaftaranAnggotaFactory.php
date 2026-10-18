<?php

namespace Database\Factories;

use App\Enums\Jurusan;
use App\Models\PendaftaranAnggota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PendaftaranAnggota>
 */
class PendaftaranAnggotaFactory extends Factory
{
    protected $model = PendaftaranAnggota::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'nama_panggilan' => $this->faker->firstName(),
            'jurusan' => $this->faker->randomElement(Jurusan::cases())->value,
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'kontak_siswa' => $this->faker->unique()->numerify('08##########'),
            'kontak_orang_tua' => $this->faker->numerify('08##########'),
            'pengalaman_basket' => $this->faker->randomElement(['iya', 'tidak', 'pernah main di sekolah lain']),
            'alasan_gabung' => $this->faker->sentence(10),
            'setuju_peraturan' => true,
            'orang_tua_mengetahui' => 'ya',
            'nis' => $this->faker->numerify('####'),
            'kelas' => $this->faker->randomElement(['10A', '10B', '11A', '11B', '12A', '12B']),
            'status' => 'pending',
            'alasan_ditolak' => null,
            'anggota_id' => null,
        ];
    }

    /**
     * Status: approved
     */
    public function approved()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }

    /**
     * Status: rejected
     */
    public function rejected()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'alasan_ditolak' => $this->faker->sentence(8),
        ]);
    }
}
