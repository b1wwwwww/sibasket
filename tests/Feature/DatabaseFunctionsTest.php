<?php

namespace Tests\Feature;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Absensi;
use App\Models\PendaftaranKegiatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class DatabaseFunctionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Function: fn_tingkat_kehadiran
     * Scenario: 1 anggota, 2 kegiatan, 1 hadir, 1 tidak hadir
     * Expected: 50% kehadiran
     */
    public function test_fn_tingkat_kehadiran_calculation_50_percent()
    {
        // Setup
        $anggota = Anggota::factory()->create(['status' => 'aktif']);
        $kegiatan1 = Kegiatan::factory()->create(['tanggal' => '2026-10-01']);
        $kegiatan2 = Kegiatan::factory()->create(['tanggal' => '2026-10-15']);

        // Daftar ke 2 kegiatan
        $pdk1 = PendaftaranKegiatan::factory()->create([
            'anggota_id' => $anggota->id,
            'kegiatan_id' => $kegiatan1->id,
            'status' => 'terdaftar'
        ]);
        $pdk2 = PendaftaranKegiatan::factory()->create([
            'anggota_id' => $anggota->id,
            'kegiatan_id' => $kegiatan2->id,
            'status' => 'terdaftar'
        ]);

        // Catat absensi: 1 hadir, 1 izin
        Absensi::factory()->create([
            'pendaftaran_id' => $pdk1->id,
            'status_kehadiran' => 'hadir'
        ]);
        Absensi::factory()->create([
            'pendaftaran_id' => $pdk2->id,
            'status_kehadiran' => 'izin'
        ]);

        // Execute function
        $result = DB::select(
            "SELECT fn_tingkat_kehadiran(?, '2026-10-01', '2026-10-31') as persentase",
            [$anggota->id]
        )[0];

        // Assert: 1 dari 2 = 50%
        $this->assertEquals(50.0, $result->persentase);
    }

    /**
     * Test Function: fn_tingkat_kehadiran
     * Scenario: Anggota tidak punya kegiatan
     * Expected: 0%
     */
    public function test_fn_tingkat_kehadiran_no_kegiatan_returns_zero()
    {
        $anggota = Anggota::factory()->create(['status' => 'aktif']);

        $result = DB::select(
            "SELECT fn_tingkat_kehadiran(?, '2026-10-01', '2026-10-31') as persentase",
            [$anggota->id]
        )[0];

        $this->assertEquals(0.0, $result->persentase);
    }

    /**
     * Test Function: fn_tingkat_kehadiran
     * Scenario: Semua kegiatan hadir
     * Expected: 100%
     */
    public function test_fn_tingkat_kehadiran_all_present_returns_100()
    {
        $anggota = Anggota::factory()->create(['status' => 'aktif']);
        $kegiatan1 = Kegiatan::factory()->create(['tanggal' => '2026-10-01']);
        $kegiatan2 = Kegiatan::factory()->create(['tanggal' => '2026-10-15']);

        $pdk1 = PendaftaranKegiatan::factory()->create([
            'anggota_id' => $anggota->id,
            'kegiatan_id' => $kegiatan1->id,
        ]);
        $pdk2 = PendaftaranKegiatan::factory()->create([
            'anggota_id' => $anggota->id,
            'kegiatan_id' => $kegiatan2->id,
        ]);

        // Semua hadir
        Absensi::factory()->create([
            'pendaftaran_id' => $pdk1->id,
            'status_kehadiran' => 'hadir'
        ]);
        Absensi::factory()->create([
            'pendaftaran_id' => $pdk2->id,
            'status_kehadiran' => 'hadir'
        ]);

        $result = DB::select(
            "SELECT fn_tingkat_kehadiran(?, '2026-10-01', '2026-10-31') as persentase",
            [$anggota->id]
        )[0];

        $this->assertEquals(100.0, $result->persentase);
    }
}
