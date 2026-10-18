# 15. Database Triggers & Stored Procedures

[← Kembali ke index](./00-README.md)

---

## Overview

SiBasket mengimplementasikan **Triggers** dan **Stored Procedures** di level MySQL untuk meningkatkan:
- **Data Integrity:** Validasi dan perubahan data dijaga otomatis oleh database
- **Performance:** Query kompleks dieksekusi di MySQL, bukan di aplikasi PHP
- **Atomicity:** Operasi multi-tabel dijamin sukses semua atau gagal semua
- **Audit Trail:** Setiap perubahan data sensitif tercatat otomatis

---

## 1. FUNCTION: `fn_tingkat_kehadiran`

### Definisi
Menghitung persentase kehadiran anggota dalam rentang tanggal tertentu.

### Signature
```sql
fn_tingkat_kehadiran(
    p_anggota_id BIGINT,
    p_start_date DATE,
    p_end_date DATE
) RETURNS DECIMAL(5,2)
```

### Logika
```
1. Hitung total kegiatan yang diikuti anggota dalam periode tertentu
2. Hitung berapa yang status 'hadir' 
3. Return: (hadir / total) * 100
```

### Penggunaan di PHP
```php
// Di Controller atau Model
$tingkatKehadiran = DB::select(
    "SELECT fn_tingkat_kehadiran(?, ?, ?) as persentase",
    [$anggotaId, '2026-10-01', '2026-10-31']
)[0]->persentase;

// Atau bisa langsung di query builder
$result = DB::select(
    DB::raw("SELECT fn_tingkat_kehadiran(?, DATE(?), DATE(?)) as persentase"),
    [$anggotaId, $startDate, $endDate]
);
```

### Contoh Output
```
Anggota ID: 5
Start: 2026-10-01
End: 2026-10-31
Output: 85.50 (artinya 85.5% hadir)
```

---

## 2. STORED PROCEDURE: `sp_approve_pendaftaran_anggota`

### Definisi
Approve pendaftaran anggota baru secara atomik: membuat User, membuat Anggota, assign Role, dan update status pendaftaran.

### Signature
```sql
CALL sp_approve_pendaftaran_anggota(
    IN p_pendaftaran_id,
    OUT p_user_id,
    OUT p_password_awal
)
```

### Logika (4 Steps Atomik)
```
1. Ambil data calon anggota dari tabel pendaftaran_anggota
2. Generate password awal: NIS + random string
3. INSERT ke users (dengan password plain yang nanti di-hash oleh Laravel)
4. INSERT ke anggota (status='aktif', tanggal_bergabung=hari ini)
5. Assign role 'Member' ke users via model_has_roles
6. UPDATE pendaftaran_anggota status='approved'
```

### Penggunaan di PHP
```php
// Di PendaftaranAnggotaController
DB::call('CALL sp_approve_pendaftaran_anggota(?, @user_id, @password)', [
    $pendaftaranId
]);

// Ambil hasil output
$results = DB::select('SELECT @user_id as user_id, @password as password');
$userId = $results[0]->user_id;
$passwordAwal = $results[0]->password;

// PENTING: Update password dengan Hash::make()
// Karena SP simpan plain text, kita perlu hash-nya di Laravel
$user = User::find($userId);
$user->password = Hash::make($passwordAwal);
$user->save();

// Tampilkan password awal ke Admin HANYA SEKALI
return response()->json([
    'message' => 'Anggota berhasil di-approve',
    'user_id' => $userId,
    'password_awal' => $passwordAwal, // Jangan disimpan, hanya ditampilkan sekali
]);
```

### Contoh Eksekusi
```
Input: pendaftaran_id = 3
       (pendaftaran_anggota id 3 punya data: Budi, NIS=001, Kelas=10A)

Output:
  p_user_id = 15 (user baru yang dibuat)
  p_password_awal = "001_a3c5f7" (password untuk disampaikan)

Perubahan Database:
  - INSERT users: id=15, name='Budi', email='001@sibasket.local', password='001_a3c5f7'
  - INSERT anggota: id=25, user_id=15, nis='001', nama='Budi', kelas='10A', status='aktif'
  - INSERT model_has_roles: role_id=3, model_type='App\\Models\\User', model_id=15
  - UPDATE pendaftaran_anggota: status='approved', anggota_id=25
```

---

## 3. TRIGGER: `audit_transaksi_kas`

### Definisi
Setiap kali ada `UPDATE` di tabel `transaksi_kas` (perubahan nominal atau status), otomatis catat ke tabel `audit_logs`.

### Event & Action
```
Event: AFTER UPDATE ON transaksi_kas
Action: INSERT ke audit_logs dengan:
  - table_name: 'transaksi_kas'
  - record_id: ID transaksi yang di-update
  - action: 'UPDATE'
  - old_value: nilai lama (nominal & status sebelum ubah)
  - new_value: nilai baru (nominal & status sesudah ubah)
  - created_at, updated_at: waktu trigger terjadi
```

### Contoh Skenario
```
UPDATE transaksi_kas SET nominal = 75000, status = 'lunas' WHERE id = 5

TRIGGER OTOMATIS MENGEKSEKUSI:
INSERT INTO audit_logs 
  (table_name, record_id, action, old_value, new_value, created_at, updated_at)
VALUES 
  ('transaksi_kas', 5, 'UPDATE', 
   'nominal:50000 status:pending', 
   'nominal:75000 status:lunas',
   NOW(), NOW())
```

### Query Audit Log dari PHP
```php
// Model: AuditLog sudah ada

// Lihat semua perubahan di tabel transaksi_kas
$auditKeuangan = AuditLog::forTable('transaksi_kas')->get();

// Lihat perubahan tertentu
$auditTransaksi5 = AuditLog::where('table_name', 'transaksi_kas')
    ->where('record_id', 5)
    ->orderBy('created_at', 'desc')
    ->get();

// Lihat siapa yang ubah (jika user_id terisi)
foreach ($auditKeuangan as $log) {
    echo $log->user->name . " mengubah transaksi " . $log->record_id;
    echo "dari " . $log->old_value . " menjadi " . $log->new_value;
}
```

---

## 4. TRIGGER: `after_transaksi_insert` (Future)

### Definisi
Saat ada `INSERT` transaksi kas yang `status='lunas'`, otomatis update saldo di tabel `kas_rutin_config`.

### Status
- ⏳ **Belum diimplementasi** — perlu kolom `saldo` di tabel `kas_rutin_config` dulu
- Akan ditambahkan di sprint berikutnya

### Logika (Nanti)
```sql
AFTER INSERT ON transaksi_kas:
  IF NEW.jenis = 'pemasukan' AND NEW.status = 'lunas' THEN
    UPDATE kas_rutin_config SET saldo = saldo + NEW.nominal
  ELSEIF NEW.jenis = 'pengeluaran' THEN
    UPDATE kas_rutin_config SET saldo = saldo - NEW.nominal
  END IF
```

---

## 📋 Implementation Checklist

### Sudah Implemented ✅
- [x] Tabel `audit_logs` dibuat via migration
- [x] Function `fn_tingkat_kehadiran` dibuat via migration
- [x] Stored Procedure `sp_approve_pendaftaran_anggota` dibuat via migration
- [x] Trigger `audit_transaksi_kas` dibuat via migration
- [x] Model `AuditLog` dibuat (`app/Models/AuditLog.php`)

### Planned ⏳
- [ ] Implementasi `after_transaksi_insert` trigger (update saldo otomatis)
- [ ] Controller untuk approve pendaftaran anggota (gunakan `sp_approve_pendaftaran_anggota`)
- [ ] Dashboard widget menampilkan tingkat kehadiran via `fn_tingkat_kehadiran`
- [ ] Audit log viewer di admin dashboard

---

## 🧪 Testing

### Test Function: `fn_tingkat_kehadiran`

```php
// File: tests/Feature/DatabaseFunctionsTest.php

public function test_tingkat_kehadiran_calculation()
{
    // Setup: 1 anggota, 2 kegiatan, 1 hadir, 1 tidak
    $anggota = Anggota::factory()->create();
    $kegiatan1 = Kegiatan::factory()->create(['tanggal' => '2026-10-01']);
    $kegiatan2 = Kegiatan::factory()->create(['tanggal' => '2026-10-15']);
    
    // Daftar ke 2 kegiatan
    PendaftaranKegiatan::factory()->create([
        'anggota_id' => $anggota->id,
        'kegiatan_id' => $kegiatan1->id
    ]);
    PendaftaranKegiatan::factory()->create([
        'anggota_id' => $anggota->id,
        'kegiatan_id' => $kegiatan2->id
    ]);
    
    // Catat absensi: 1 hadir, 1 izin
    Absensi::factory()->create([
        'pendaftaran_id' => 1,
        'status_kehadiran' => 'hadir'
    ]);
    Absensi::factory()->create([
        'pendaftaran_id' => 2,
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
```

### Test Stored Procedure: `sp_approve_pendaftaran_anggota`

```php
// File: tests/Feature/DatabaseProceduresTest.php

public function test_approve_pendaftaran_anggota_creates_user_and_anggota()
{
    // Setup
    $pendaftaranAnggota = PendaftaranAnggota::factory()->create([
        'nama' => 'Budi',
        'nis' => '001',
        'kelas' => '10A',
        'jurusan' => 'PPLG'
    ]);
    
    // Execute procedure
    DB::call('CALL sp_approve_pendaftaran_anggota(?, @user_id, @password)', [
        $pendaftaranAnggota->id
    ]);
    
    // Get output
    $result = DB::select('SELECT @user_id as user_id, @password as password')[0];
    
    // Assert: User dibuat
    $this->assertNotNull($result->user_id);
    $user = User::find($result->user_id);
    $this->assertEquals('Budi', $user->name);
    
    // Assert: Anggota dibuat
    $anggota = Anggota::where('user_id', $result->user_id)->first();
    $this->assertNotNull($anggota);
    $this->assertEquals('001', $anggota->nis);
    $this->assertEquals('aktif', $anggota->status);
    
    // Assert: Role 'Member' di-assign
    $this->assertTrue($user->hasRole('Member'));
    
    // Assert: Pendaftaran status approved
    $pendaftaranAnggota->refresh();
    $this->assertEquals('approved', $pendaftaranAnggota->status);
}
```

---

## 📚 Dokumentasi Lengkap

Untuk penjelasan lebih detail tentang business logic yang diimplementasikan:
- `docs/04-business-flow-dan-rules.md` — Aturan bisnis
- `docs/06-database.md` — Struktur database
- `docs/03-struktur-website-dan-fitur.md` — Fitur dan workflow

---

**Last Updated:** 18 Oktober 2026
**Status:** 3/4 implemented (audit_transaksi_kas ada, after_transaksi_insert planned)
