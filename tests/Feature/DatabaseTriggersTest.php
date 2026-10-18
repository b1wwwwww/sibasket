<?php

namespace Tests\Feature;

use App\Models\TransaksiKas;
use App\Models\Anggota;
use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class DatabaseTriggersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Trigger: audit_transaksi_kas
     * Verify: UPDATE transaksi_kas otomatis insert ke audit_logs
     */
    public function test_audit_trigger_on_transaksi_kas_update()
    {
        // Setup
        $anggota = Anggota::factory()->create();
        $transaksi = TransaksiKas::factory()->create([
            'anggota_id' => $anggota->id,
            'nominal' => 50000,
            'status' => 'pending',
            'jenis' => 'pemasukan'
        ]);

        // Clear any existing audit logs
        AuditLog::truncate();

        // Execute UPDATE
        $transaksi->update([
            'nominal' => 75000,
            'status' => 'lunas'
        ]);

        // Assert: Audit log dibuat
        $auditLog = AuditLog::where('table_name', 'transaksi_kas')
            ->where('record_id', $transaksi->id)
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertEquals('UPDATE', $auditLog->action);
        $this->assertStringContainsString('50000', $auditLog->old_value);
        $this->assertStringContainsString('75000', $auditLog->new_value);
        $this->assertStringContainsString('pending', $auditLog->old_value);
        $this->assertStringContainsString('lunas', $auditLog->new_value);
    }

    /**
     * Test Trigger: audit_transaksi_kas
     * Verify: Multiple updates create multiple audit logs
     */
    public function test_audit_trigger_tracks_multiple_updates()
    {
        $anggota = Anggota::factory()->create();
        $transaksi = TransaksiKas::factory()->create([
            'anggota_id' => $anggota->id,
            'nominal' => 50000,
            'status' => 'pending'
        ]);

        AuditLog::truncate();

        // First update
        $transaksi->update(['nominal' => 75000]);
        
        // Second update
        $transaksi->update(['status' => 'lunas']);

        // Assert: 2 audit logs created
        $auditLogs = AuditLog::where('table_name', 'transaksi_kas')
            ->where('record_id', $transaksi->id)
            ->get();

        $this->assertCount(2, $auditLogs);
    }
}
