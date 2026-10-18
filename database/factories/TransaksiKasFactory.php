<?php

namespace Database\Factories;

use App\Models\TransaksiKas;
use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransaksiKas>
 */
class TransaksiKasFactory extends Factory
{
    protected $model = TransaksiKas::class;

    public function definition(): array
    {
        return [
            'anggota_id' => Anggota::factory(),
            'nominal' => $this->faker->randomElement([50000, 75000, 100000, 150000, 200000]),
            'jenis' => $this->faker->randomElement(['pemasukan', 'pengeluaran']),
            'kategori' => $this->faker->randomElement(['iuran', 'donasi', 'hadiah', 'peralatan', 'transportasi']),
            'status' => $this->faker->randomElement(['lunas', 'nunggak', 'pending']),
            'tanggal_bayar' => $this->faker->dateTimeBetween('-3 months'),
            'keterangan' => $this->faker->optional(0.5)->sentence(),
        ];
    }

    /**
     * State: Pemasukan
     */
    public function pemasukan()
    {
        return $this->state(fn (array $attributes) => [
            'jenis' => 'pemasukan',
            'kategori' => $this->faker->randomElement(['iuran', 'donasi']),
        ]);
    }

    /**
     * State: Pengeluaran
     */
    public function pengeluaran()
    {
        return $this->state(fn (array $attributes) => [
            'jenis' => 'pengeluaran',
            'kategori' => $this->faker->randomElement(['peralatan', 'transportasi', 'hadiah']),
        ]);
    }

    /**
     * State: Lunas
     */
    public function lunas()
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'lunas',
        ]);
    }
}
