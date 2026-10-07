
# Skenario Full Livewire — SIBASKET Pivot (Pertimbangan)

> File ini adalah analisis mendalam untuk keputusan pivot dari Filament ke Full Livewire.
> **Ditulis:** 06 Oktober 2026
> **Status:** Pertimbangan — Keputusan belum final

---

## 1. Konteks Keputusan

**Masalah dengan Filament:**
- Interface terasa kaku & template (bukan custom UX)
- Admin nanti merasa ribet dengan admin panel standar
- Learning outcome terbatas (hanya config, bukan build)

**Solusi: Full Livewire**
- Custom UI → Admin interface yang lebih user-friendly
- Lebih learning (paham Livewire lifecycle, components)
- Portfolio lebih standout (bukan "Filament scaffold standar")

**Trade-off utama:** Timeline lebih panjang (6 minggu vs 3-4 minggu Filament)

---

## 2. Architecture — Full Livewire (No Filament)

```
┌─────────────────────────────────────────────┐
│  SIBASKET - Full Livewire (No Filament)     │
├─────────────────────────────────────────────┤
│                                             │
│  https://sibasket.com/                      │
│  ├─ / (Halaman Publik - Blade)              │
│  │   ├─ Profil organisasi                   │
│  │   ├─ Jadwal kegiatan                     │
│  │   └─ Pengumuman                          │
│  │                                          │
│  ├─ /auth/login (Auth - Blade)              │
│  │   └─ Login form sederhana                │
│  │                                          │
│  ├─ /dashboard (Livewire - Auth Required)   │
│  │   ├─ Admin Dashboard (Bendahara, Sie)    │
│  │   │   ├─ List Anggota (Livewire table)   │
│  │   │   ├─ List Kegiatan (Livewire table)  │
│  │   │   ├─ Absensi (Livewire form + table) │
│  │   │   ├─ Keuangan (Livewire form + table)│
│  │   │   └─ Pengumuman (Livewire CRUD)      │
│  │   │                                      │
│  │   └─ Member Dashboard (Anggota Biasa)    │
│  │       ├─ Riwayat absensi pribadi         │
│  │       ├─ Pembayaran kas pribadi          │
│  │       └─ Kegiatan yang terdaftar         │
│  │                                          │
│  └─ /admin (Admin Panel - Blade/Livewire)   │
│      └─ Config & Management                │
│                                             │
└─────────────────────────────────────────────┘
```

**Key Points:**
- **Livewire handle semuanya** (table, form, filter, search, validation)
- **No Filament** (no admin panel generator)
- **Blade templates** untuk layout, design custom sepenuhnya
- **Database triggers/functions** tetap sama (independent dari UI)

---

## 3. File Structure — Full Livewire Setup

```
app/
├─ Livewire/
│  ├─ AnggotaTable.php              (Livewire component untuk tabel anggota)
│  ├─ AnggotaForm.php               (Livewire component untuk form add/edit)
│  ├─ KegiatanTable.php
│  ├─ KegiatanForm.php
│  ├─ PendaftaranKegiatanTable.php
│  ├─ PendaftaranKegiatanForm.php
│  ├─ AbsensiTable.php
│  ├─ AbsensiForm.php
│  ├─ TransaksiKasTable.php
│  ├─ TransaksiKasForm.php
│  ├─ PengumumanTable.php
│  ├─ PengumumanForm.php
│  ├─ RecapAbsensi.php              (Summary component)
│  ├─ MemberDashboard.php           (Member view only)
│  └─ AdminDashboard.php            (Dashboard widgets)
│
├─ Models/
│  ├─ Anggota.php
│  ├─ Kegiatan.php
│  ├─ PendaftaranKegiatan.php
│  ├─ Absensi.php
│  ├─ TransaksiKas.php
│  ├─ Pengumuman.php
│  ├─ User.php
│  └─ AuditLog.php                  (Untuk track perubahan)
│
├─ Http/
│  ├─ Controllers/
│  │  ├─ PageController.php         (Route halaman utama)
│  │  └─ AuthController.php         (Login/logout logic)
│  │
│  └─ Middleware/
│     ├─ AdminMiddleware.php        (Cek role admin)
│     └─ MemberMiddleware.php       (Cek role member)
│
└─ Traits/
   └─ CanSearchAndFilter.php        (Reusable logic untuk Livewire)

resources/
├─ views/
│  ├─ layouts/
│  │  ├─ app.blade.php              (Main layout dengan sidebar)
│  │  ├─ auth.blade.php             (Layout login)
│  │  └─ components/
│  │     ├─ sidebar.blade.php
│  │     ├─ navbar.blade.php
│  │     ├─ button.blade.php
│  │     ├─ modal.blade.php
│  │     ├─ alert.blade.php
│  │     └─ pagination.blade.php
│  │
│  ├─ pages/
│  │  ├─ dashboard.blade.php        (Admin dashboard utama)
│  │  ├─ anggota.blade.php          (Load <livewire:anggota-table />)
│  │  ├─ kegiatan.blade.php
│  │  ├─ pendaftaran-kegiatan.blade.php
│  │  ├─ absensi.blade.php
│  │  ├─ keuangan.blade.php
│  │  ├─ pengumuman.blade.php
│  │  ├─ member-dashboard.blade.php (Member view)
│  │  ├─ index.blade.php            (Halaman publik)
│  │  ├─ jadwal.blade.php           (Public - jadwal kegiatan)
│  │  └─ pengumuman-publik.blade.php (Public - pengumuman)
│  │
│  └─ livewire/
│     ├─ anggota-table.blade.php    (Template untuk component)
│     ├─ anggota-form.blade.php
│     ├─ kegiatan-table.blade.php
│     ├─ kegiatan-form.blade.php
│     ├─ pendaftaran-kegiatan-table.blade.php
│     ├─ pendaftaran-kegiatan-form.blade.php
│     ├─ absensi-table.blade.php
│     ├─ absensi-form.blade.php
│     ├─ transaksi-kas-table.blade.php
│     ├─ transaksi-kas-form.blade.php
│     ├─ pengumuman-table.blade.php
│     ├─ pengumuman-form.blade.php
│     ├─ recap-absensi.blade.php
│     ├─ member-dashboard.blade.php
│     └─ admin-dashboard.blade.php

database/
├─ migrations/
│  ├─ xxxx_create_anggota_table.php
│  ├─ xxxx_create_kegiatan_table.php
│  ├─ xxxx_create_pendaftaran_kegiatan_table.php
│  ├─ xxxx_create_absensi_table.php
│  ├─ xxxx_create_transaksi_kas_table.php
│  ├─ xxxx_create_pengumuman_table.php
│  ├─ xxxx_create_audit_logs_table.php
│  ├─ xxxx_create_kas_rutin_config_table.php
│  └─ triggers_and_functions.sql  (Triggers, functions di SQL raw)
│
└─ seeders/
   ├─ DatabaseSeeder.php
   ├─ UserSeeder.php
   ├─ AnggotaSeeder.php
   ├─ KegiatanSeeder.php
   └─ RolePermissionSeeder.php
```

---

## 4. Timeline Realistis: Full Livewire (6 Minggu)

### MINGGU 1 (Oct 6-12): Setup + Cleanup

```
├─ Hari 1-2: Remove Filament, Setup Livewire structure
│  ├─ composer remove filament/filament
│  ├─ Setup app/Livewire folder structure
│  ├─ Setup resources/views/livewire folder
│  └─ Setup routes (auth, page, admin)
│
├─ Hari 3-4: Bikin reusable components & layout
│  ├─ Layout dasar (app.blade.php dengan sidebar)
│  ├─ Navbar component
│  ├─ Sidebar navigation
│  ├─ Reusable button, modal, alert components
│  └─ Tailwind CSS setup (atau Bootstrap)
│
├─ Hari 5: Setup authorization & middleware
│  ├─ Role/Permission middleware
│  ├─ Gate & Policy setup
│  └─ Auth logic (login blade, logout route)
│
└─ Status: Layout skeleton siap, Livewire structure ready
   Deliverable: Dashboard halaman polos, bisa login/logout
```

**Effort:** ~40 jam (setup fondasi, baru mulai Livewire)

---

### MINGGU 2 (Oct 13-19): Anggota & Kegiatan Livewire

```
├─ Hari 1-2: Livewire AnggotaTable
│  ├─ Create AnggotaTable.php component
│  ├─ Template list dengan table (search, filter, paginate)
│  ├─ Action button (edit, delete, detail)
│  └─ Real-time search & filter (Livewire reactivity)
│
├─ Hari 3-4: Livewire AnggotaForm
│  ├─ Create AnggotaForm.php component
│  ├─ Template form untuk create/edit
│  ├─ Validation real-time
│  ├─ File upload untuk foto (optional)
│  └─ Save & redirect ke list
│
├─ Hari 5: Kegiatan Table & Form
│  ├─ Copy pattern dari Anggota untuk Kegiatan
│  ├─ KegiatanTable (list kegiatan dengan filter tgl, status)
│  ├─ KegiatanForm (create/edit)
│  └─ Setup relationship Kegiatan → Anggota (many-to-many via pendaftaran)
│
└─ Status: Anggota & Kegiatan bisa di-CRUD di Livewire
   Deliverable: /dashboard/anggota & /dashboard/kegiatan page sudah functional
   Estimated: ~45 jam kerja
```

**Testing:** Create anggota baru, edit, delete → verify di database

---

### MINGGU 3 (Oct 20-26): Absensi & Keuangan Livewire

```
├─ Hari 1-2: Livewire AbsensiTable & Form
│  ├─ AbsensiTable (list absensi per kegiatan)
│  ├─ AbsensiForm (input manual kehadiran: Hadir/Izin/Sakit/Alpa)
│  ├─ Filter by Kegiatan & Status
│  ├─ Color coding badge (green/blue/yellow/red)
│  └─ Catatan textarea (optional)
│
├─ Hari 3: Recap Absensi Component
│  ├─ RecapAbsensi.php (summary component)
│  ├─ Tabel: Nama Anggota, Total Kegiatan, Hadir, Izin, Sakit, Alpa
│  ├─ Kolom persentase kehadiran
│  └─ Sort & filter untuk identifikasi absensi tinggi
│
├─ Hari 4-5: Livewire TransaksiKasTable & Form
│  ├─ TransaksiKasTable (list semua transaksi kas)
│  ├─ TransaksiKasForm (input pemasukan/pengeluaran)
│  ├─ Filter by jenis (pemasukan/pengeluaran), kategori, status
│  ├─ Nominal input dengan formatting (Rp)
│  └─ Tanggal bayar picker
│
├─ Hari 6: Setup database triggers & functions
│  ├─ Migration raw SQL: trigger update saldo kas otomatis
│  ├─ Migration raw SQL: function hitung saldo per bulan
│  ├─ Migration raw SQL: function hitung persentase absensi
│  └─ Test trigger dengan input transaksi manual
│
└─ Status: Core business logic (absensi & keuangan) berjalan
   Deliverable: /dashboard/absensi, /dashboard/keuangan page functional
   Estimated: ~50 jam kerja
```

**Testing:** Input absensi & transaksi, verify triggers update saldo otomatis

---

### MINGGU 4 (Oct 27-Nov 2): Database Advanced + Member Dashboard

```
├─ Hari 1-2: Implement rollback/commit logic
│  ├─ Setup DB::transaction() di setiap Controller create/update/delete
│  ├─ Rollback otomatis jika ada validation error
│  ├─ Commit logic dengan audit trail logging
│  └─ Test transaction dengan deliberate error injection
│
├─ Hari 3-4: Audit Trail & Log System
│  ├─ Migration tabel audit_logs
│  ├─ AuditLog model & trait
│  ├─ Log setiap perubahan (create, update, delete)
│  ├─ Track user, action, model, changes
│  └─ Dashboard view untuk audit history
│
├─ Hari 5: Livewire MemberDashboard
│  ├─ MemberDashboard.php component
│  ├─ View-only: Absensi pribadi (kegiatan → status kehadiran)
│  ├─ View-only: Pembayaran kas pribadi (sudah bayar berapa)
│  ├─ View-only: Kegiatan terdaftar (nama kegiatan, tanggal, status)
│  ├─ Authorization: Member hanya lihat data diri sendiri
│  └─ Member dashboard page
│
└─ Status: Full business logic + member access complete
   Deliverable: /dashboard/member page, audit system berjalan
   Estimated: ~40 jam kerja
```

**Testing:** Login as member, verify hanya lihat data pribadi. Login as admin, lihat audit log.

---

### MINGGU 5 (Nov 3-9): Pengumuman, Export, Polish

```
├─ Hari 1-2: Livewire PengumumanTable & Form
│  ├─ PengumumanTable (list pengumuman)
│  ├─ PengumumanForm (create/edit/delete)
│  ├─ WYSIWYG editor untuk content (optional: TinyMCE / Quill)
│  ├─ Tanggal publikasi & status (draft/published)
│  └─ Sort by terbaru
│
├─ Hari 3: Public halaman pengumuman
│  ├─ /pengumuman-publik (Blade, no auth)
│  ├─ List pengumuman yang published
│  ├─ Detail pengumuman (buka modal atau page detail)
│  └─ Display tanggal, penulis, content
│
├─ Hari 4: Export feature (absensi & kas)
│  ├─ Export absensi per kegiatan ke Excel (Laravel Excel)
│  ├─ Export laporan keuangan (bulanan/tahunan) ke PDF/Excel
│  ├─ Button di halaman keuangan & absensi
│  └─ Test download file
│
├─ Hari 5: Dashboard widgets + UX polish
│  ├─ AdminDashboard component (cards statistik)
│  │  ├─ Total anggota aktif
│  │  ├─ Total kegiatan bulan ini
│  │  ├─ Saldo kas hari ini
│  │  ├─ Pendaftar pending (kegiatan)
│  │  └─ Chart: trend saldo kas (chart.js)
│  ├─ Color scheme & responsive design (mobile-friendly)
│  ├─ Validasi form yang user-friendly (error message jelas)
│  └─ Loading indicator & skeleton screen
│
└─ Status: Semua fitur lengkap, UI polish complete
   Deliverable: Full site berjalan, export working
   Estimated: ~45 jam kerja
```

**Testing:** Export file, verify format correct. Test responsif di mobile browser.

---

### MINGGU 6 (Nov 10-14): Testing, Bug Fix, Deployment

```
├─ Hari 1-2: Testing per role
│  ├─ Login as Bendahara → hanya akses keuangan, absensi (view)
│  ├─ Login as Sie Absensi → hanya akses absensi
│  ├─ Login as Admin/Ketua → akses semua
│  ├─ Login as Member → akses dashboard pribadi (view-only)
│  └─ Test publik halaman (no login required)
│
├─ Hari 3: Bug fix & refinement
│  ├─ Fix Livewire reactivity issues (jika ada)
│  ├─ Validasi data edge cases
│  ├─ Performance optimization (query optimization, lazy load)
│  └─ Browser compatibility test (Chrome, Firefox, Safari)
│
├─ Hari 4: Setup deployment
│  ├─ Setup .env untuk production
│  ├─ Run migrations & seeders di production (tes lokal dulu)
│  ├─ Setup web server (nginx/apache)
│  ├─ SSL certificate (HTTPS)
│  └─ Database backup strategy
│
├─ Hari 5: Final handover & documentation
│  ├─ Write admin user guide (screenshot, video)
│  ├─ Setup super admin akun pertama
│  ├─ Train bendahara/sie absensi (walkthrough)
│  ├─ Document database triggers & functions
│  └─ Deployment checklist
│
└─ Status: Production ready ✅
   Deliverable: Live website, user guide, trained admin
```

**Testing:** Do smoke test di production (create anggota, input absensi, transaksi kas).

---

## 5. Perbedaan Effort: Filament vs Full Livewire

| Aspek | Filament | Full Livewire |
|---|---|---|
| **Setup awal** | 1 hari | 2-3 hari |
| **Per CRUD module** | 30 min (scaffold + config) | 4-6 jam (component + template + logic) |
| **Table features** | Built-in (filter, search, sort, paginate) | Manual di component |
| **Form validation** | Built-in reactive | Manual di component ($rules) |
| **Authorization** | Filament Shield (built-in) | Manual gate/policy + middleware |
| **Mobile responsive** | Default (ok) | Perlu CSS effort (Tailwind/Bootstrap) |
| **Customization** | Terbatas (headless plugin perlu kerja) | Unlimited (full control HTML/CSS) |
| **Learning curve** | Filament API (resource, form, table builder) | Livewire lifecycle, reactivity, wire:* directives |
| **Total time to production** | ~3-4 minggu | ~6 minggu |
| **Admin UX** | **"Terasa admin panel"** ⚠️ | **"Terasa aplikasi biasa"** ✅ |
| **Portfolio appeal** | Standar (Filament scaffold terlihat) | Standout (custom built interface) |
| **Debugging** | Filament errors jelas | Livewire debugging bisa tricky |
| **Team onboarding** | Mudah (resource pattern sudah familiar) | Butuh training Livewire lifecycle |

---

## 6. Database Requirements — Triggers, Functions, Rollback, Commit

**Requirements adalah independent dari UI framework (Filament vs Livewire).**

### A. Triggers

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

**Trigger 2: Update saldo kas saat delete transaksi (untuk rollback manual)**
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

### B. Functions

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

**Function 3: Hitung kas yang sudah dibayar vs nunggak per anggota**
```sql
CREATE FUNCTION get_status_kas_anggota(p_anggota_id INT, p_bulan INT, p_tahun INT)
RETURNS VARCHAR(50)
BEGIN
  DECLARE status_text VARCHAR(50);
  DECLARE sudah_bayar INT;
  
  SELECT COUNT(*) INTO sudah_bayar
  FROM transaksi_kas
  WHERE anggota_id = p_anggota_id
  AND jenis = 'pemasukan'
  AND MONTH(tanggal_bayar) = p_bulan
  AND YEAR(tanggal_bayar) = p_tahun;
  
  RETURN IF(sudah_bayar > 0, 'Lunas', 'Nunggak');
END;
```

### C. Rollback & Commit (Inline di Laravel Controller)

**Pattern di Livewire Component:**
```php
<?php

namespace App\Livewire;

use App\Models\TransaksiKas;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransaksiKasForm extends Component
{
    public $nominal;
    public $jenis;
    public $kategori;
    public $tanggal_bayar;
    public $keterangan;
    
    public $rules = [
        'nominal' => 'required|numeric|min:1000',
        'jenis' => 'required|in:pemasukan,pengeluaran',
        'kategori' => 'required|string',
        'tanggal_bayar' => 'required|date',
    ];
    
    public function save()
    {
        $this->validate();
        
        // TRANSACTION: Mulai database transaction
        DB::transaction(function () {
            // Create transaksi kas
            $transaksi = TransaksiKas::create([
                'anggota_id' => auth()->id(),
                'nominal' => $this->nominal,
                'jenis' => $this->jenis,
                'kategori' => $this->kategori,
                'tanggal_bayar' => $this->tanggal_bayar,
                'keterangan' => $this->keterangan,
                'status' => 'lunas',
            ]);
            // Trigger database otomatis execute (update saldo kas)
            
            // Log audit trail (manual track)
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'create',
                'model' => 'TransaksiKas',
                'model_id' => $transaksi->id,
                'changes' => json_encode([
                    'nominal' => $this->nominal,
                    'jenis' => $this->jenis,
                ]),
            ]);
            
            // Jika ada error di sini, otomatis ROLLBACK semua
        });
        // COMMIT: Jika sukses keluar transaction, otomatis COMMIT ke DB
        
        $this->reset();
        session()->flash('message', 'Transaksi kas berhasil disimpan');
    }
}
```

**Pattern untuk Delete (Rollback Manual):**
```php
public function delete($id)
{
    DB::transaction(function () use ($id) {
        $transaksi = TransaksiKas::findOrFail($id);
        
        // Log sebelum delete (audit trail)
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'model' => 'TransaksiKas',
            'model_id' => $id,
            'changes' => json_encode($transaksi->toArray()),
        ]);
        
        $transaksi->delete();
        // Trigger database otomatis execute (update saldo kas turun)
        
        // Jika ada error, otomatis ROLLBACK
    });
    // COMMIT otomatis jika sukses
    
    session()->flash('message', 'Transaksi kas berhasil dihapus');
}
```

### D. Audit Trail Table

**Migration untuk audit trail:**
```php
Schema::create('audit_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('action'); // create, update, delete
    $table->string('model'); // TransaksiKas, Absensi, etc
    $table->integer('model_id');
    $table->longText('changes')->nullable(); // JSON field
    $table->string('ip_address')->nullable();
    $table->timestamps();
    
    $table->index(['model', 'model_id']);
});
```

---

## 7. Pro & Con — Full Livewire

### ✅ Keuntungan (Pro)

1. **Admin Interface User-Friendly**
   - Custom UI → tidak "terasa template"
   - Admin merasa lebih comfortable menggunakan
   - UX sesuai kebutuhan admin, bukan framework

2. **Learning Outcome Tinggi**
   - Paham Livewire lifecycle (mount, updating, updated, render)
   - Paham component reactivity & wire:* directives
   - Paham database transactions & triggers
   - Portofolio skill lebih mendalam

3. **Portfolio Standout**
   - Bukan "Filament admin panel" standar (terlihat begitu di mata recruiter)
   - Custom Livewire interface menunjukkan skill build dari nol
   - Better for portfolio CV

4. **Mobile Responsif**
   - Livewire + Tailwind = responsif by default
   - Admin bisa kelola dari smartphone

5. **Scalable**
   - Nanti tinggal add Livewire component baru
   - Tidak terbatas framework limitations
   - Mudah extend untuk phase 2 (android, features baru)

### ❌ Kerugian (Con)

1. **Timeline Lebih Panjang**
   - 6 minggu vs 3-4 minggu Filament
   - Risk: tertinggal jika sibuk di minggu 2-4
   - Minggu pertama hanya setup & cleanup Filament

2. **Effort Lebih Besar**
   - Per component harus manual setup (no scaffolding)
   - Table features (filter, search, sort) perlu code sendiri
   - Form validation perlu setup di component
   - Authorization perlu check manual (no Shield plugin)

3. **Debugging Lebih Kompleks**
   - Livewire reactivity bisa tricky
   - State management bisa confusing di awal
   - Performance issues sulit di-track (lazy load, query optimization)

4. **Risk vs Deadline**
   - Kalau Ada sibuk minggu 2-3, bisa ketinggalan
   - Harus disciplined dengan timeline
   - Less room for error/delay

5. **Onboarding Tim Sulit**
   - Kalau nanti perlu dev tambahan, harus train Livewire
   - Filament lebih "standard" di Indonesia

---

## 8. Rekomendasi Akhir — Keputusan?

### ✅ **Ambil Full Livewire JIKA:**

- ✔️ Mau admin interface **benar-benar user-friendly** (not "terasa template")
- ✔️ Punya waktu **5-6 minggu** (terutama minggu 2-4 harus fokus, jangan divide attention)
- ✔️ Willing belajar **Livewire component lifecycle** (learning curve Ada, tapi worth it)
- ✔️ Ujikom butuh **portofolio yang standout** (custom Livewire > Filament scaffold)
- ✔️ Comfortable dengan **debugging Livewire** (ada learning curve, tapi feasible)
- ✔️ **Strict deadline 14 Nov** bukan hard blocker (Ada punya buffer 1-2 hari)

**Expected Outcome:**
- Custom UI yang rapi & user-friendly
- Backend solid dengan triggers, functions, transactions
- Portfolio code quality tinggi
- Grade ujikom good (backend-focused, database requirements complete)

---

### ⚠️ **Jangan ambil Full Livewire JIKA:**

- ❌ Sibuk parah di minggu 2-3 (project lain, exam, kerja)
- ❌ Preferensi **cepat keluarin** (grade dulu, UX second)
- ❌ Tidak yakin Livewire (takut stuck di debugging Livewire reactivity)
- ❌ Timeline **super ketat** (Ada hanya punya 4 minggu efektif)
- ❌ Butuh onboarding tim development (Filament lebih familiar)

**Alternative: Hybrid (Filament Admin + Livewire Public)**
- Keep Filament untuk admin (cepat, solid)
- Build Livewire untuk public halaman & member dashboard
- Timeline: 4-5 minggu (compromise)
- Result: Still good portfolio + meet deadline comfortably

---

## 9. Langkah Selanjutnya — Jika Setuju Full Livewire

Jika Anda **final keputusan Full Livewire**, langkah next:

1. **Update dokumentasi progress** (DOKUMENTASI-PROGRES-SIBASKET-v2.md)
   - Add timeline 6 minggu (Oct 6 - Nov 14)
   - Mark pivot decision: "Full Livewire (drop Filament)"
   - Update roadmap per minggu

2. **Uninstall Filament**
   ```bash
   composer remove filament/filament bezhansalleh/filament-shield
   npm install
   ```

3. **Setup Livewire structure** (minggu 1)
   - Folder app/Livewire
   - Folder resources/views/livewire
   - Folder resources/views/layouts & pages
   - Blade layout dasar dengan sidebar

4. **Setup database triggers & functions** (sambil UI berkembang)
   - Migration raw SQL untuk triggers
   - Migration raw SQL untuk functions
   - Test di local database

5. **Mulai dari AnggotaTable** (minggu 2)
   - First Livewire component sebagai POC (proof of concept)
   - Test: create, read, update, delete via Livewire
   - Verify Livewire reactivity bekerja

---

## 10. Summary — Keputusan Anda?

| Opsi | Timeline | Effort | UX | Portfolio | Risk |
|---|---|---|---|---|---|
| **Full Filament** | 3-4 minggu | 50 jam | Kaku (template) | Standar | Rendah |
| **Hybrid (Filament + Livewire)** | 4-5 minggu | 70 jam | Baik (partial custom) | Baik | Sedang |
| **Full Livewire** | 6 minggu | 100+ jam | Excellent (full custom) | Excellent | Tinggi |

**Yang Anda pilih untuk SIBASKET?**

A. Full Livewire → Saya mulai setup cleanup Filament & structure Livewire
B. Hybrid → Saya tetap Filament admin, bikin Livewire public halaman
C. Full Filament → Saya continue dengan keuangan & database triggers

---

> **File ini di-update:** 06 Oktober 2026
> **Status:** Keputusan pending — Silakan diskusi dengan guru/mentor sebelum final commit
