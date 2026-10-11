<?php

namespace Tests\Unit;

use App\Models\Pengumuman;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengumumanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Pengumuman dapat dibuat dengan data valid
     */
    public function test_pengumuman_dapat_dibuat()
    {
        $data = [
            'judul' => 'Test Pengumuman',
            'isi' => 'Ini adalah isi pengumuman untuk testing',
            'tanggal_publish' => now()->format('Y-m-d'),
        ];

        $pengumuman = Pengumuman::create($data);

        $this->assertNotNull($pengumuman->id);
        $this->assertEquals($data['judul'], $pengumuman->judul);
        $this->assertEquals($data['isi'], $pengumuman->isi);
    }

    /**
     * Test: Pengumuman dapat diupdate
     */
    public function test_pengumuman_dapat_diupdate()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Original Title',
            'isi' => 'Original Content',
            'tanggal_publish' => now()->format('Y-m-d'),
        ]);

        $pengumuman->update([
            'judul' => 'Updated Title',
            'isi' => 'Updated Content',
        ]);

        $this->assertEquals('Updated Title', $pengumuman->judul);
        $this->assertEquals('Updated Content', $pengumuman->isi);
    }

    /**
     * Test: Pengumuman dapat dihapus
     */
    public function test_pengumuman_dapat_dihapus()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Will Be Deleted',
            'isi' => 'This will be deleted',
            'tanggal_publish' => now()->format('Y-m-d'),
        ]);

        $id = $pengumuman->id;
        $pengumuman->delete();

        $this->assertNull(Pengumuman::find($id));
    }

    /**
     * Test: Pengumuman dapat dicari berdasarkan judul
     */
    public function test_pengumuman_dapat_dicari_berdasarkan_judul()
    {
        Pengumuman::create([
            'judul' => 'Jadwal Latihan Basket',
            'isi' => 'Content 1',
            'tanggal_publish' => now()->format('Y-m-d'),
        ]);

        Pengumuman::create([
            'judul' => 'Pengumuman Penting Lainnya',
            'isi' => 'Content 2',
            'tanggal_publish' => now()->format('Y-m-d'),
        ]);

        $hasil = Pengumuman::where('judul', 'like', '%Jadwal%')->get();

        $this->assertCount(1, $hasil);
        $this->assertEquals('Jadwal Latihan Basket', $hasil->first()->judul);
    }

    /**
     * Test: Pengumuman dapat diurutkan berdasarkan tanggal publish
     */
    public function test_pengumuman_dapat_diurutkan_berdasarkan_tanggal()
    {
        $tua = Pengumuman::create([
            'judul' => 'Pengumuman Lama',
            'isi' => 'Old',
            'tanggal_publish' => now()->subDays(5)->format('Y-m-d'),
        ]);

        $baru = Pengumuman::create([
            'judul' => 'Pengumuman Baru',
            'isi' => 'New',
            'tanggal_publish' => now()->format('Y-m-d'),
        ]);

        $hasil = Pengumuman::orderBy('tanggal_publish', 'desc')->get();

        $this->assertEquals($baru->id, $hasil->first()->id);
        $this->assertEquals($tua->id, $hasil->last()->id);
    }

    /**
     * Test: Cast tanggal_publish menjadi date
     */
    public function test_tanggal_publish_di_cast_menjadi_date()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Test',
            'isi' => 'Test',
            'tanggal_publish' => '2026-10-15',
        ]);

        $this->assertInstanceOf(Carbon::class, $pengumuman->tanggal_publish);
        $this->assertEquals('2026-10-15', $pengumuman->tanggal_publish->format('Y-m-d'));
    }
}
