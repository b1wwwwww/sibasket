# 13. Full Livewire Decision & Analysis (Pivot dari Filament)

[← Kembali ke index](./00-README.md)

> **Tanggal Keputusan:** 07 Oktober 2026 (WIB)
> **Status:** ✅ FINAL — Pivot approved, mulai implementation Full Livewire
> **Timeline:** 6 minggu (Oct 6 - Nov 14)

---

## 1. Latar Belakang Keputusan

### Masalah dengan Filament

- Interface terasa **kaku & template** (tidak custom UX)
- Admin nanti merasa ribet dengan admin panel yang standar
- Learning outcome **terbatas** (hanya config, bukan build)
- Portfolio terlihat standar (banyak dev juga pakai Filament scaffold)

### Solusi: Full Livewire

- Custom UI → Admin interface yang **benar-benar user-friendly**
- Lebih **learning outcome tinggi** (paham Livewire lifecycle, components, database design)
- Portfolio **standout** (custom Livewire > Filament scaffold standar)
- Integrated login flow (satu halaman login untuk semua role, bukan terpisah)

---

## 2. Perbandingan Tiga Opsi

| Aspek | Full Filament | Hybrid (Filament + Livewire) | Full Livewire |
|---|---|---|---|
| **Timeline** | 3-4 minggu | 4-5 minggu | 6 minggu |
| **Effort** | 50 jam | 70 jam | 100+ jam |
| **Setup awal** | 1 hari | 1.5 hari | 2-3 hari |
| **Per CRUD module** | 30 min | 2-3 jam | 4-6 jam |
| **Admin UX** | Terasa template ⚠️ | Baik (partial custom) | Excellent (full custom) ✅ |
| **Portfolio Appeal** | Standar | Baik | Standout ✅ |
| **Mobile Responsif** | Ok | Good | Excellent ✅ |
| **Scalability** | Terbatas (plugin) | Baik | Unlimited ✅ |
| **Learning Curve** | Config API | Mix | Build from scratch |
| **Debugging** | Jelas | Moderate | Kompleks |

**PILIHAN:** ✅ **Full Livewire** (dipilih karena learning outcome & portfolio standout)

---

## 3. Keuntungan Full Livewire

### ✅ Admin Interface User-Friendly

- Custom UI → **tidak terasa template**
- Admin merasa lebih comfortable menggunakan
- UX sesuai kebutuhan admin, bukan framework limitation

### ✅ Learning Outcome Tinggi

- Paham **Livewire lifecycle** (mount, updating, updated, render)
- Paham **component reactivity** & wire:* directives
- Paham **database transactions** & triggers
- Skill lebih mendalam untuk **portofolio**

### ✅ Portfolio Standout

- Bukan "Filament admin panel" standar (semua orang bisa)
- Custom Livewire = **skill build dari nol** (impressive untuk CV)
- Lebih cocok untuk **ujikom & recruitment**

### ✅ Member Dashboard Integrated

- Tidak hanya admin panel
- Member login, lihat data pribadi (absensi, kas, kegiatan)
- **Satu aplikasi, bukan terpisah** public vs. admin

### ✅ Scalable & Flexible

- Nanti tinggal add Livewire component baru
- Tidak terbatas framework limitations
- Mudah extend untuk **phase 2** (fitur baru, mobile app, API)

---

## 4. Tantangan & Risiko

### ❌ Timeline Lebih Panjang

- **6 minggu** vs 3-4 minggu Filament
- Risk jika sibuk di minggu 2-4
- **Harus disiplin timeline**, especially minggu 2-4

### ❌ Effort Lebih Besar

- Per component harus **manual setup** (no scaffolding)
- Table features (filter, search, sort) harus **code sendiri**
- Form validation & authorization perlu **setup manual**

### ❌ Debugging Lebih Kompleks

- Livewire reactivity bisa **tricky** di awal
- State management butuh **understanding yang baik**
- Performance issues sulit di-track (lazy load, query optimization)

### ❌ Less Buffer untuk Error

- Tidak ada banyak ruang untuk delay
- Kalau ada issue Livewire, bisa tertinggal dari timeline
- Harus willing untuk **troubleshoot & learn on-the-fly**

---

## 5. Login Flow: Full Livewire vs Filament

### ❌ FILAMENT FLOW (Kaku & Terpisah)

```
Halaman publik: https://sibasket.com/
  ├─ Navbar ada tombol "Login" 
  └─ Link ke: https://sibasket.com/admin/login (TERPISAH)
  
Admin login page: https://sibasket.com/admin/login
  └─ Form login (email, password)
  └─ Masuk ke: https://sibasket.com/admin (dashboard admin)
  
Member akses:
  └─ Hanya bisa akses halaman publik (tidak ada member login)
```

**Masalah:** Ada 2 halaman login terpisah, UX terasa kaku & tidak integrated.

---

### ✅ FULL LIVEWIRE FLOW (Elegant & Integrated)

```
Halaman publik: https://sibasket.com/
  ├─ Navbar ada tombol "Login" (1 tombol aja)
  └─ Link ke: https://sibasket.com/auth/login (SATU halaman login)

Login page: https://sibasket.com/auth/login
  ├─ Form login (email, password) - SATU form untuk semua
  └─ System cek role user:

Setelah login:
  ├─ Jika ADMIN/BENDAHARA/SIE → redirect ke /dashboard (admin dashboard)
  │   └─ Sidebar dinamis sesuai permission
  │
  ├─ Jika MEMBER → redirect ke /dashboard (member dashboard)
  │   └─ Sidebar dinamis, hanya menu yang dibolehkan
  │
  └─ Jika GUEST → redirect ke /auth/login
```

**Keuntungan:**
- **Satu tombol login** (lebih clean)
- **Satu halaman login** untuk semua (UX lebih simple)
- Dashboard **adjust menu sesuai role** (tidak hardcoded)
- Terasa seperti **normal application, bukan admin panel terpisah**
- **Admin & member same entry point** (professional UX)

---

## 6. Contoh Flow Praktis (3 Skenario)

### Skenario 1: Bendahara Login

```
1. Klik "Login" di navbar halaman publik
2. Masuk form login: 
   - email: bendahara@sibasket.com
   - password: ****
3. System cek role → BENDAHARA
4. Redirect ke /dashboard
5. Sidebar otomatis show:
   ✅ Keuangan (CRUD)
   ✅ Absensi (read-only)
   ✅ Pengumuman (CRUD)
   ❌ Menu anggota & kegiatan tidak muncul
6. Bendahara manage transaksi kas, lihat absensi
```

### Skenario 2: Member Login

```
1. Klik "Login" di navbar (TOMBOL SAMA)
2. Masuk form login: 
   - email: member@sibasket.com
   - password: ****
3. System cek role → MEMBER
4. Redirect ke /dashboard
5. Sidebar otomatis show:
   ✅ Absensi Saya (view-only)
   ✅ Kas Saya (view-only)
   ✅ Kegiatan Saya (view-only)
   ❌ Menu admin tidak muncul sama sekali
6. Member hanya lihat data diri sendiri (protected by authorization)
```

### Skenario 3: Admin Super (Ketua)

```
1. Klik "Login" di navbar
2. Masuk form login:
   - email: ketua@sibasket.com
   - password: ****
3. System cek role → ADMIN
4. Redirect ke /dashboard
5. Sidebar otomatis show:
   ✅ Anggota (CRUD)
   ✅ Kegiatan (CRUD)
   ✅ Pendaftaran Kegiatan
   ✅ Absensi (CRUD)
   ✅ Keuangan (read-only / view)
   ✅ Pengumuman (CRUD)
   ✅ Dashboard Statistik
6. Admin punya akses penuh (kecuali yang read-only per role)
```

---

## 7. Database Requirements (Independent dari UI)

Database layer tetap **sama** baik Filament maupun Livewire.

### Triggers

**Trigger 1: Update saldo kas otomatis saat insert transaksi**
```sql
CREATE TRIGGER update_saldo_after_insert
AFTER INSERT ON transaksi_kas
FOR EACH ROW
BEGIN
  UPDATE kas_rutin_config 
  SET saldo = saldo + NEW.nominal 
  WHERE id = 1;
END;
```

**Trigger 2: Update saldo kas saat delete transaksi**
```sql
CREATE TRIGGER update_saldo_after_delete
AFTER DELETE ON transaksi_kas
FOR EACH ROW
BEGIN
  UPDATE kas_rutin_config 
  SET saldo = saldo - OLD.nominal 
  WHERE id = 1;
END;
```

### Functions

**Function 1: Hitung saldo kas untuk bulan tertentu**
```sql
CREATE FUNCTION get_saldo_bulan(p_bulan INT, p_tahun INT)
RETURNS DECIMAL
BEGIN
  RETURN (
    SELECT COALESCE(SUM(nominal), 0) 
    FROM transaksi_kas 
    WHERE MONTH(tanggal_bayar) = p_bulan 
    AND YEAR(tanggal_bayar) = p_tahun
  );
END;
```

**Function 2: Hitung persentase absensi per anggota**
```sql
CREATE FUNCTION get_persentase_absensi(p_anggota_id INT)
RETURNS DECIMAL
BEGIN
  DECLARE total_kegiatan INT;
  DECLARE total_hadir INT;
  
  SELECT COUNT(*) INTO total_kegiatan 
  FROM pendaftaran_kegiatan 
  WHERE anggota_id = p_anggota_id;
  
  SELECT COUNT(*) INTO total_hadir 
  FROM absensi 
  WHERE pendaftaran_kegiatan_id IN 
    (SELECT id FROM pendaftaran_kegiatan WHERE anggota_id = p_anggota_id)
  AND status = 'hadir';
  
  RETURN IF(total_kegiatan = 0, 0, ROUND((total_hadir / total_kegiatan) * 100, 2));
END;
```

### Rollback & Commit Pattern (di Livewire Component)

```php
public function save()
{
    $this->validate();
    
    // Transaction: mulai database transaction
    DB::transaction(function () {
        // Create data
        $transaksi = TransaksiKas::create([...]);
        // Trigger database execute otomatis (update saldo kas)
        
        // Log audit trail (manual track)
        AuditLog::create([...]);
        
        // Jika ada error di sini, otomatis ROLLBACK semua
    });
    // COMMIT: Jika sukses keluar transaction, otomatis COMMIT ke DB
    
    session()->flash('message', 'Transaksi kas berhasil disimpan');
}
```

---

## 8. Kesimpulan & Komitmen

### ✅ Dengan Full Livewire kamu dapat:

- **Login flow yang elegant** (satu halaman login, integrated)
- **Admin interface custom** (bukan template standar)
- **Member dashboard** (bukan hanya admin panel)
- **Learning outcome tinggi** (Livewire + database design)
- **Portfolio standout** (custom built, impressive untuk CV)

### ⚠️ Tapi harus committed:

- **6 minggu timeline** (vs 3-4 minggu Filament)
- **100+ jam effort** (besar, tapi manageable)
- **Disiplin minggu 2-4** (terutama, jangan bagi perhatian)
- **Paham Livewire lifecycle** (learning curve Ada, tapi worth it)
- **Siap troubleshoot** (debugging Livewire lebih kompleks)

---

## 9. Next Steps

1. **Remove Filament:**
   ```bash
   composer remove filament/filament bezhansalleh/filament-shield
   npm install
   ```

2. **Setup Livewire structure** (lihat `14-full-livewire-skenario.md` section 3)
   - Folder `app/Livewire`
   - Folder `resources/views/livewire`
   - Blade layout dasar dengan sidebar

3. **Setup database triggers & functions** (sambil UI berkembang)
   - Migration raw SQL untuk triggers
   - Test di local database

4. **Mulai dari AnggotaTable** (minggu 2)
   - First Livewire component sebagai POC
   - Test: create, read, update, delete via Livewire

5. **Update dokumentasi progress** 
   - Mark pivot decision di `12-changelog-dan-notes.md`
   - Ikuti timeline 6 minggu di `09-roadmap-6-minggu.md`

---

> **Status:** ✅ Full Livewire decision FINAL
> **Last updated:** 07 Oktober 2026
> **Next review:** Setelah Minggu 1 selesai (12 Oktober 2026)
