# SIBASKET — Master Prompt Comprehensive
## Full Project Context: Database, Flows, Architecture & Admin Dashboard

**Project:** Sistem Manajemen Eskul Basket\
**Stack:** Laravel 13 + Livewire 4 + Tailwind CSS + MySQL (with Triggers)\
**Status:** MVP Complete (96%) — Production Belum Ready\ masih banyak fitur tambahan yg belum jalan dan sedikit bug
**Deadline:** Nov 14, 2026\
**Last Updated:** Oct 26, 2026

---

## TABLE OF CONTENTS
1. [Project Overview](#1-project-overview)
2. [Technology Stack & Architecture](#2-technology-stack--architecture)
3. [Database Schema & Relationships](#3-database-schema--relationships)
4. [Role-Based Access Control](#4-role-based-access-control)
5. [Core Business Flows](#5-core-business-flows)
6. [Module Specifications](#6-module-specifications)
7. [Admin Dashboard Components](#7-admin-dashboard-components)
8. [API Routes & Endpoints](#8-api-routes--endpoints)
9. [Key Technical Implementations](#9-key-technical-implementations)
10. [Deployment & Final Checklist](#10-deployment--final-checklist)

---

## 1. PROJECT OVERVIEW

### 1.1 Deskripsi Produk
SIBASKET adalah aplikasi web terpusat untuk manajemen Eskul Basket yang menggantikan pencatatan manual (grup WhatsApp, catatan kertas, Excel terpisah). Aplikasi terdiri dari:

- **Public Website** — Homepage, Jadwal Kegiatan, Pengumuman, Form Pendaftaran Anggota Baru (untuk guest)
- **Admin Dashboard** — CRUD Anggota, Kegiatan, Absensi, Keuangan, Pengumuman (untuk pengurus)
- **Member Area** — View-only untuk data pribadi (absensi, pembayaran kas, kegiatan terdaftar)

### 1.2 Tujuan
1. Memusatkan data anggota, jadwal, kehadiran dalam satu sistem
2. Validasi otomatis pendaftaran kegiatan (kuota, status aktif, duplikasi)
3. Visibilitas real-time untuk pembina (anggota aktif, tingkat kehadiran, keuangan)
4. Laporan terstruktur untuk akuntabilitas

### 1.3 Masalah yang Diselesaikan
| Masalah | Kondisi Lama | Solusi |
|---------|-------------|--------|
| Data anggota tersebar | Grup WA, catatan manual | Modul Manajemen Anggota terpusat |
| Absensi dicatat manual | Rawan hilang, sulit direkap | Modul Absensi digital per kegiatan |
| Pendaftaran kegiatan via chat | Rawan duplikat & salah data | Validasi otomatis + unique constraint |
| Pengumuman tersebar | Info terlambat/tidak konsisten | Modul Pengumuman + publikasi terjadwal |
| Tracking keuangan manual | Kas mengambang, tidak tertrack | Modul Keuangan real-time sync |

---

## 2. TECHNOLOGY STACK & ARCHITECTURE

### 2.1 Tech Stack

| Layer | Teknologi | Versi |
|-------|-----------|-------|
| **Backend** | Laravel | 11+ (LTS) |
| **Language** | PHP | 8.2+ |
| **Database** | MySQL | 8.0+ |
| **Frontend** | Livewire + Blade | 3.x |
| **CSS** | Tailwind CSS | 3.x |
| **Authentication** | Laravel Breeze + Spatie | Latest |
| **Permissions** | Spatie Laravel-Permission | 6.x+ |
| **Export** | Maatwebsite/Excel | 4.0.4+ |
| **PDF** | Laravel DomPDF | 3.1.2+ |
| **Deployment** | Laravel (shared hosting / VPS) | - |

### 2.2 Application Architecture

```
SIBASKET
  │
  ├── PUBLIC PAGES (Guest, No Auth)
  │   ├── /home — Landing page + tentang
  │   ├── /kegiatan — Jadwal publik
  │   ├── /pengumuman — Berita publik
  │   ├── /kegiatan/{id} — Detail kegiatan
  │   ├── /pendaftar-anggota — Form publik (guest submit)
  │   └── /auth/login — Login page
  │
  ├── ADMIN DASHBOARD (/dashboard — Role-Based)
  │   ├── Dashboard (ringkasan role-specific)
  │   ├── Anggota (CRUD)
  │   ├── Kegiatan (CRUD)
  │   ├── Pendaftaran Kegiatan (view per kegiatan)
  │   ├── Absensi (input + rekap + bulk actions)
  │   ├── Keuangan (Kas Anggota + Pengeluaran)
  │   ├── Pengumuman (CRUD)
  │   ├── Pendaftar Baru (approval workflow)
  │   ├── Laporan & Export (Excel/PDF)
  │   ├── User & Role Management (Super Admin only)
  │   └── Settings
  │
  ├── DATABASE LAYER
  │   ├── 10+ Core Tables
  │   ├── 3 Triggers (auto-sync kas, audit logs)
  │   ├── 2 Stored Procedures (approve pendaftaran, calculate attendance)
  │   ├── 2 Functions (attendance %, balance calculation)
  │   └── Observers (Laravel) untuk auto-sync
  │
  └── AUTHENTICATION & PERMISSIONS (Spatie)
      ├── Users (login credentials)
      ├── Roles (Super Admin, Admin, Bendahara, Sie Absensi, Pembina, Member)
      └── Permissions (manage-anggota, manage-kegiatan, manage-absensi, etc.)
```

### 2.3 Key Architectural Decisions

1. **Full Livewire** (not Filament)
   - Alasan: Custom UI, better learning outcome, scalable, integrated login
   - Trade-off: 6 minggu development vs 3-4 minggu (Filament)

2. **Database-Centric**
   - Triggers untuk auto-sync (consistent data)
   - Stored procedures untuk business logic (integrity)
   - Observers di Laravel untuk soft-sync & logging

3. **Role-Based Sidebar Menu**
   - Satu halaman login untuk semua role
   - Menu dinamis per role (bukan URL prefix berbeda)
   - Authorization di component level (Livewire policies)

---

## 3. DATABASE SCHEMA & RELATIONSHIPS

### 3.1 Core Tables

```sql
users
  ├── id (PK)
  ├── name
  ├── email (UNIQUE)
  ├── username (UNIQUE) — filled from NIS (for member)
  ├── password
  ├── force_password_change (BOOL) — untuk akun baru, wajib ganti password
  ├── email_verified_at
  └── timestamps

roles (Spatie)
  ├── id (PK)
  ├── name (Super Admin, Admin, Bendahara, Sie Absensi, Pembina, Member)
  ├── guard_name
  └── timestamps

permissions (Spatie)
  ├── id (PK)
  ├── name (manage-anggota, view-anggota, manage-kegiatan, etc.)
  ├── guard_name
  └── timestamps

model_has_roles (Spatie pivot)
  ├── role_id (FK)
  └── model_id + model_type (User)

model_has_permissions (Spatie pivot)
  ├── permission_id (FK)
  └── model_id + model_type (User or Role)

anggota
  ├── id (PK)
  ├── user_id (FK → users) — nullable untuk historical anggota
  ├── nis (UNIQUE) — nomor identitas siswa
  ├── nama
  ├── kelas
  ├── jurusan (optional)
  ├── posisi (PG, SG, C, SF, PF — optional)
  ├── status (aktif, nonaktif)
  ├── tanggal_bergabung
  ├── no_telepon (optional)
  └── timestamps

kegiatan
  ├── id (PK)
  ├── judul
  ├── deskripsi
  ├── tanggal_mulai (datetime)
  ├── tanggal_selesai (datetime, nullable) — durasi kegiatan
  ├── lokasi
  ├── kuota (nullable) — null = unlimited
  ├── kategori (latihan, pertandingan, seleksi, gathering, lainnya)
  ├── foto (path, nullable) — storage/app/public/kegiatan/
  ├── status (draft, published, ongoing, completed, cancelled)
  ├── created_by (FK → users)
  └── timestamps

pendaftaran_kegiatan (pivot: anggota ↔ kegiatan)
  ├── id (PK)
  ├── anggota_id (FK)
  ├── kegiatan_id (FK)
  ├── status (terdaftar, dibatalkan)
  └── created_at (waktu daftar)

absensi
  ├── id (PK)
  ├── pendaftaran_kegiatan_id (FK) — link ke anggota + kegiatan
  ├── tanggal_kehadiran (date) — optional untuk tracking per-tanggal
  ├── status_kehadiran (enum: hadir, izin, sakit, alpa)
  ├── catatan (text, nullable)
  └── timestamps

pendaftaran_anggota (form publik — calon anggota)
  ├── id (PK)
  ├── nama
  ├── nis (UNIQUE)
  ├── kelas
  ├── kontak (WA/email)
  ├── alasan_gabung (text, nullable)
  ├── status (pending, approved, rejected)
  ├── alasan_ditolak (text, nullable)
  ├── anggota_id (FK, nullable) — filled saat approve
  └── created_at

transaksi_kas
  ├── id (PK)
  ├── jenis (pemasukan, pengeluaran)
  ├── kategori (Kas Anggota, Pengeluaran Operasional, dll)
  ├── nominal (DECIMAL)
  ├── keterangan (text)
  ├── referensi_id (nullable — FK ke tabel lain, e.g., pendaftaran_anggota_id)
  ├── tanggal_transaksi (date)
  ├── dibuat_oleh (FK → users)
  └── timestamps

kas_anggota (one-to-many dengan transaksi_kas atau standalone)
  ├── id (PK)
  ├── kegiatan_id (FK) — kas per kegiatan latihan
  ├── anggota_id (FK)
  ├── nominal_per_anggota (DECIMAL) — default Rp 5.000
  ├── sudah_bayar (BOOL)
  ├── tanggal_bayar (date, nullable)
  └── timestamps

pengeluaran_operasional
  ├── id (PK)
  ├── kategori (Booking Lapang, Beli Barang, Bantu Teman, Lainnya)
  ├── nominal (DECIMAL)
  ├── keterangan (text)
  ├── note_penalangan (text, nullable) — untuk tracking menalangi teman
  ├── tanggal_pengeluaran (date)
  ├── dibuat_oleh (FK → users)
  └── timestamps

pengumuman
  ├── id (PK)
  ├── judul
  ├── isi (text)
  ├── status (draft, published)
  ├── kategori (Penting, Info, Prestasi, Lainnya)
  ├── foto (path, nullable)
  ├── is_pinned (BOOL) — pin ke top
  ├── tanggal_publish (date)
  ├── dibuat_oleh (FK → users)
  └── timestamps

audit_logs
  ├── id (PK)
  ├── action (create, update, delete)
  ├── model (Anggota, Kegiatan, Absensi, TransaksiKas, etc.)
  ├── model_id (FK)
  ├── old_values (JSON)
  ├── new_values (JSON)
  ├── user_id (FK → users)
  ├── ip_address
  └── created_at
```

### 3.2 Relationships (Eloquent)

```
User
  ├── hasMany(Anggota) — anggota dengan user_id
  ├── hasMany(Role) — via Spatie
  └── hasMany(Permission) — via Spatie

Anggota
  ├── belongsTo(User)
  ├── hasMany(PendaftaranKegiatan)
  └── hasMany(Absensi, through PendaftaranKegiatan)

Kegiatan
  ├── belongsTo(User, 'created_by')
  ├── hasMany(PendaftaranKegiatan)
  ├── hasMany(Anggota, through PendaftaranKegiatan)
  └── hasMany(Absensi)

PendaftaranKegiatan
  ├── belongsTo(Anggota)
  ├── belongsTo(Kegiatan)
  └── hasOne(Absensi)

Absensi
  ├── belongsTo(PendaftaranKegiatan)
  ├── belongsTo(Anggota, through PendaftaranKegiatan)
  └── belongsTo(Kegiatan, through PendaftaranKegiatan)

PendaftaranAnggota
  ├── belongsTo(Anggota) — nullable, filled saat approve

TransaksiKas
  ├── belongsTo(User, 'dibuat_oleh')
  └── polymorphic — referensi ke berbagai tabel

KasAnggota
  ├── belongsTo(Kegiatan)
  └── belongsTo(Anggota)

Pengumuman
  ├── belongsTo(User, 'dibuat_oleh')
```

### 3.3 Key Constraints & Indexes

```sql
-- Unique constraints (prevent duplicate data)
ALTER TABLE anggota ADD UNIQUE(nis);
ALTER TABLE users ADD UNIQUE(email), UNIQUE(username);
ALTER TABLE pendaftaran_kegiatan ADD UNIQUE(anggota_id, kegiatan_id);
ALTER TABLE pendaftaran_anggota ADD UNIQUE(nis);

-- Foreign key constraints
ALTER TABLE pendaftaran_kegiatan ADD FOREIGN KEY (anggota_id) REFERENCES anggota(id) ON DELETE CASCADE;
ALTER TABLE pendaftaran_kegiatan ADD FOREIGN KEY (kegiatan_id) REFERENCES kegiatan(id) ON DELETE CASCADE;
ALTER TABLE absensi ADD FOREIGN KEY (pendaftaran_kegiatan_id) REFERENCES pendaftaran_kegiatan(id) ON DELETE CASCADE;

-- Indexes untuk performa (frequently queried)
CREATE INDEX idx_anggota_status ON anggota(status);
CREATE INDEX idx_kegiatan_status ON kegiatan(status);
CREATE INDEX idx_kegiatan_tanggal ON kegiatan(tanggal_mulai);
CREATE INDEX idx_pendaftaran_kegiatan_anggota ON pendaftaran_kegiatan(anggota_id);
CREATE INDEX idx_pendaftaran_kegiatan_kegiatan ON pendaftaran_kegiatan(kegiatan_id);
CREATE INDEX idx_absensi_kegiatan ON absensi(pendaftaran_kegiatan_id);
CREATE INDEX idx_transaksi_kas_tanggal ON transaksi_kas(tanggal_transaksi);
CREATE INDEX idx_audit_logs_model ON audit_logs(model, model_id);
```

### 3.4 Database Triggers (MySQL)

```sql
-- TRIGGER 1: Auto-update saldo kas saat transaksi
CREATE TRIGGER tg_update_saldo_kas
AFTER INSERT ON transaksi_kas
FOR EACH ROW
BEGIN
  IF NEW.jenis = 'pemasukan' THEN
    UPDATE dashboard_metrics SET saldo_kas = saldo_kas + NEW.nominal;
  ELSE
    UPDATE dashboard_metrics SET saldo_kas = saldo_kas - NEW.nominal;
  END IF;
  -- Optional: bisa disimpan ke table terpisah untuk audit
END;

-- TRIGGER 2: Audit log setiap perubahan keuangan
CREATE TRIGGER tg_audit_keuangan
AFTER INSERT ON transaksi_kas
FOR EACH ROW
BEGIN
  INSERT INTO audit_logs (action, model, model_id, new_values, user_id, created_at)
  VALUES ('insert', 'TransaksiKas', NEW.id, 
          JSON_OBJECT('jenis', NEW.jenis, 'nominal', NEW.nominal),
          NEW.dibuat_oleh, NOW());
END;
```

### 3.5 Stored Procedures

```sql
-- PROCEDURE 1: Approve pendaftaran anggota baru + auto-create user/anggota
DELIMITER $$
CREATE PROCEDURE sp_approve_pendaftaran_anggota(
  IN p_pendaftaran_id BIGINT,
  IN p_admin_id BIGINT
)
BEGIN
  DECLARE v_user_id BIGINT;
  DECLARE v_nis VARCHAR(50);
  
  START TRANSACTION;
  
  -- Get NIS dari pendaftaran_anggota
  SELECT nis INTO v_nis FROM pendaftaran_anggota WHERE id = p_pendaftaran_id;
  
  -- Create User baru (username = NIS)
  INSERT INTO users (name, username, email, password, force_password_change, created_at)
  VALUES (
    (SELECT nama FROM pendaftaran_anggota WHERE id = p_pendaftaran_id),
    v_nis,
    CONCAT(v_nis, '@sibasket.local'),
    CONCAT('$2y$10$', SHA2(CONCAT(v_nis, RAND()), 256)),
    1,
    NOW()
  );
  
  SET v_user_id = LAST_INSERT_ID();
  
  -- Create Anggota baru
  INSERT INTO anggota (user_id, nis, nama, kelas, status, tanggal_bergabung, created_at)
  VALUES (
    v_user_id,
    v_nis,
    (SELECT nama FROM pendaftaran_anggota WHERE id = p_pendaftaran_id),
    (SELECT kelas FROM pendaftaran_anggota WHERE id = p_pendaftaran_id),
    'aktif',
    NOW(),
    NOW()
  );
  
  -- Update pendaftaran_anggota
  UPDATE pendaftaran_anggota 
  SET status = 'approved', anggota_id = LAST_INSERT_ID() 
  WHERE id = p_pendaftaran_id;
  
  -- Assign Member role
  INSERT INTO model_has_roles (role_id, model_id, model_type)
  VALUES ((SELECT id FROM roles WHERE name = 'Member'), v_user_id, 'App\\Models\\User');
  
  -- Audit log
  INSERT INTO audit_logs (action, model, model_id, new_values, user_id, created_at)
  VALUES ('approve', 'PendaftaranAnggota', p_pendaftaran_id, 
          JSON_OBJECT('user_id', v_user_id, 'anggota_id', LAST_INSERT_ID()),
          p_admin_id, NOW());
  
  COMMIT;
END$$
DELIMITER ;

-- PROCEDURE 2: Calculate tingkat kehadiran per anggota
DELIMITER $$
CREATE PROCEDURE sp_calculate_attendance_rate(
  IN p_anggota_id BIGINT,
  OUT p_attendance_rate DECIMAL(5,2)
)
BEGIN
  DECLARE v_total_kegiatan INT;
  DECLARE v_hadir INT;
  
  SELECT COUNT(DISTINCT kegiatan_id) INTO v_total_kegiatan
  FROM pendaftaran_kegiatan WHERE anggota_id = p_anggota_id;
  
  SELECT COUNT(*) INTO v_hadir
  FROM absensi a
  JOIN pendaftaran_kegiatan pk ON a.pendaftaran_kegiatan_id = pk.id
  WHERE pk.anggota_id = p_anggota_id AND a.status_kehadiran = 'hadir';
  
  IF v_total_kegiatan > 0 THEN
    SET p_attendance_rate = (v_hadir / v_total_kegiatan) * 100;
  ELSE
    SET p_attendance_rate = 0;
  END IF;
END$$
DELIMITER ;
```

### 3.6 Database Functions

```sql
-- FUNCTION 1: Hitung tingkat kehadiran (%)
CREATE FUNCTION fn_tingkat_kehadiran(p_kegiatan_id BIGINT)
RETURNS DECIMAL(5,2)
READS SQL DATA
BEGIN
  DECLARE v_total INT;
  DECLARE v_hadir INT;
  
  SELECT COUNT(*) INTO v_total FROM pendaftaran_kegiatan WHERE kegiatan_id = p_kegiatan_id;
  SELECT COUNT(*) INTO v_hadir FROM absensi a
    JOIN pendaftaran_kegiatan pk ON a.pendaftaran_kegiatan_id = pk.id
    WHERE pk.kegiatan_id = p_kegiatan_id AND a.status_kehadiran = 'hadir';
  
  RETURN IFNULL((v_hadir / v_total) * 100, 0);
END;

-- FUNCTION 2: Hitung saldo kas current
CREATE FUNCTION fn_saldo_kas_current()
RETURNS DECIMAL(12,2)
READS SQL DATA
BEGIN
  DECLARE v_pemasukan DECIMAL(12,2);
  DECLARE v_pengeluaran DECIMAL(12,2);
  
  SELECT IFNULL(SUM(nominal), 0) INTO v_pemasukan FROM transaksi_kas WHERE jenis = 'pemasukan';
  SELECT IFNULL(SUM(nominal), 0) INTO v_pengeluaran FROM transaksi_kas WHERE jenis = 'pengeluaran';
  
  RETURN v_pemasukan - v_pengeluaran;
END;
```

---

## 4. ROLE-BASED ACCESS CONTROL

### 4.1 Roles & Permissions Matrix

| Feature | Super Admin | Ketua | Bendahara | Sie Absensi | Pembina | Member | Guest |
|---------|:-:|:-:|:-:|:-:|:-:|:-:|:-:|
| **Dashboard** | ✓ Full | ✓ Full | ✓ Limited | ✓ Limited | ✓ View-only | ✓ Personal | - |
| **Anggota** | ✓ CRUD | ✓ CRUD | ✓ CRUD | ✓ CRUD | ✓ View | - | - |
| **Kegiatan** | ✓ CRUD | ✓ CRUD | - | ✓ CRUD | ✓ View | ✓ View+Daftar | ✓ View |
| **Pendaftaran Kegiatan** | ✓ CRUD | ✓ View | - | ✓ View | ✓ View | ✓ Own only | - |
| **Absensi** | ✓ CRUD | - | - | ✓ CRUD+Bulk | ✓ View | ✓ Own only | - |
| **Keuangan** | ✓ CRUD | - | ✓ CRUD | - | ✓ View | - | - |
| **Pengumuman** | ✓ CRUD | ✓ CRUD | ✓ CRUD | ✓ CRUD | ✓ View | ✓ View | ✓ View |
| **Pendaftar Baru** | ✓ Approve | ✓ Approve | - | ✓ Approve | ✓ View | - | ✓ Submit |
| **User & Role** | ✓ Full | - | - | - | - | - | - |
| **Laporan & Export** | ✓ Full | ✓ View | ✓ View | ✓ View | ✓ View | - | - |

### 4.2 Spatie Permission Setup

```php
// Roles
['Super Admin', 'Admin', 'Bendahara', 'Sie Absensi', 'Pembina', 'Member']

// Permissions (Granular)
[
  // Anggota
  'manage-anggota', 'view-anggota', 'create-anggota', 'update-anggota', 'delete-anggota',
  
  // Kegiatan
  'manage-kegiatan', 'view-kegiatan', 'create-kegiatan', 'update-kegiatan', 'delete-kegiatan',
  
  // Absensi
  'manage-absensi', 'view-absensi', 'create-absensi', 'update-absensi', 'bulk-absensi',
  
  // Keuangan
  'manage-keuangan', 'view-keuangan', 'create-keuangan', 'update-keuangan', 'delete-keuangan',
  
  // Pengumuman
  'manage-pengumuman', 'view-pengumuman', 'publish-pengumuman',
  
  // Laporan
  'view-laporan', 'export-laporan',
  
  // Admin User & Role
  'manage-users', 'manage-roles', 'manage-permissions'
]

// Role-Permission Assignments
Super Admin → All permissions
Admin → Semua kecuali manage-users, manage-roles, manage-permissions (partial)
Bendahara → manage-keuangan, view-anggota, view-laporan, etc.
Sie Absensi → manage-absensi, manage-kegiatan, view-keuangan, etc.
Pembina → view-* only (semua)
Member → view-kegiatan, view-absensi-own, view-keuangan-own
```

### 4.3 Gate & Policy Examples

```php
// Gate: Super Admin bypass (can do anything)
Gate::define('super_admin', function (User $user) {
  return $user->hasRole('Super Admin');
});

// Policy: User hanya bisa lihat data pribadi sendiri
class AbsensiPolicy {
  public function view(User $user, Absensi $absensi) {
    if ($user->hasRole('Super Admin')) return true;
    if ($user->hasPermissionTo('manage-absensi')) return true;
    
    // Member hanya lihat absensi sendiri
    return $absensi->pendaftaranKegiatan->anggota->user_id === $user->id;
  }
}

// Authorization di Livewire Component
class AbsensiTable extends Component {
  public function mount() {
    $this->authorize('manage-absensi');
  }
}
```

---

## 5. CORE BUSINESS FLOWS

### 5.1 Flow: Pendaftaran Anggota Baru (Guest → Member)

```
┌─ GUEST (Publik) ─────────────────────────────────────┐
│                                                        │
│  1. Buka /pendaftar-anggota (form publik)             │
│  2. Isi: Nama, NIS, Kelas, Kontak (WA/email)         │
│  3. Submit                                             │
│     Validasi:                                          │
│       • NIS belum pernah didaftar sebelumnya?         │
│       • Format input valid?                            │
│     ↓ Jika valid                                       │
│  4. Tersimpan di tabel `pendaftaran_anggota`         │
│     Status: PENDING                                    │
│                                                        │
└────────────────────────────────────────────────────────┘

┌─ ADMIN (Approval) ───────────────────────────────────┐
│                                                        │
│  1. Buka /dashboard/pendaftar-baru                    │
│  2. Review data calon anggota                         │
│  3a. APPROVE                                           │
│      ↓                                                 │
│      Trigger: sp_approve_pendaftaran_anggota()        │
│        • Create User (username=NIS, pwd=random)      │
│        • Create Anggota (status=aktif)               │
│        • Assign Role=Member                           │
│        • Set force_password_change=true              │
│      ↓                                                 │
│      Update pendaftaran_anggota.status = 'approved'   │
│      ↓                                                 │
│      Admin melihat password awal (1x saja)           │
│      Admin komunikasi ke calon anggota (WA/manual)   │
│                                                        │
│  3b. REJECT                                            │
│      ↓                                                 │
│      Update status = 'rejected'                       │
│      Catat alasan penolakan                           │
│                                                        │
└────────────────────────────────────────────────────────┘

┌─ NEW MEMBER (First Login) ────────────────────────────┐
│                                                        │
│  1. Login dengan NIS + password awal                  │
│  2. Sistem deteksi force_password_change=true        │
│  3. Redirect ke halaman "Ganti Password"             │
│  4. Member wajib set password baru                    │
│  5. Update force_password_change=false               │
│  6. Redirect ke /dashboard                           │
│  7. Member bisa akses member area sepenuhnya         │
│                                                        │
└────────────────────────────────────────────────────────┘
```

### 5.2 Flow: Pendaftaran Kegiatan (Member → Terdaftar)

```
┌─ MEMBER (Browse Kegiatan) ───────────────────────────┐
│                                                        │
│  1. Login ke /dashboard                              │
│  2. Buka menu Kegiatan                               │
│  3. Lihat daftar kegiatan berstatus 'published'      │
│  4. Klik "Daftar" pada kegiatan pilihan              │
│     Validasi:                                         │
│       • Member aktif? (status='aktif')               │
│       • Sudah terdaftar kegiatan ini? (unique)       │
│       • Kegiatan masih menerima? (status ≠ completed) │
│       • Kuota tersedia? (if kuota set)               │
│     ↓ Jika semua valid                               │
│  5. Create record di `pendaftaran_kegiatan`          │
│     Status: 'terdaftar'                              │
│  6. Toast: "Pendaftaran berhasil"                    │
│  7. Member bisa lihat di Riwayat Pendaftaran         │
│                                                        │
└────────────────────────────────────────────────────────┘

Validasi Gagal?
  → Toast Error: "Anda sudah terdaftar" / "Kuota penuh" / "Kegiatan ditutup" / dll
```

### 5.3 Flow: Input Absensi (Admin → Catat Kehadiran)

```
┌─ ADMIN (Bulk Absensi Input) ─────────────────────────┐
│                                                        │
│  1. Buka /dashboard/absensi                          │
│  2. Filter: Pilih Kegiatan + Tanggal                 │
│     → List anggota yang terdaftar kegiatan itu       │
│  3. Input status kehadiran per anggota:              │
│     • Dropdown: Hadir / Izin / Sakit / Alpa         │
│     • Optional: Catatan (keterangan)                 │
│  4. QUICK ACTIONS (Bulk)                            │
│     • "Hadir Semua" → Set semua anggota = Hadir      │
│     • "Tidak Semua" → Set semua anggota = Alpa      │
│     • "Reset" → Clear semua data absensi hari ini   │
│  5. Klik "Simpan"                                    │
│     ↓                                                 │
│     Create/Update `absensi` records                  │
│     ↓                                                 │
│     Trigger: tg_audit_keuangan (log ke audit_logs)   │
│     ↓                                                 │
│  6. Toast: "Absensi tersimpan"                       │
│  7. Dashboard otomatis update metrics                │
│     (tingkat kehadiran, saldo kas jika ada capaian)  │
│                                                        │
└────────────────────────────────────────────────────────┘
```

### 5.4 Flow: Manajemen Keuangan (Dual Structure)

```
┌─ ADMIN/BENDAHARA (Keuangan Page) ────────────────────┐
│                                                        │
│  SECTION 1: KAS ANGGOTA (Iuran Latihan)              │
│  ─────────────────────────────────                   │
│  1. Dropdown: Pilih Kegiatan Latihan                 │
│  2. List anggota yang terdaftar + status bayar       │
│  3. Toggle "Sudah Bayar" per anggota                 │
│  4. Automatic: Trigger tg_update_saldo_kas          │
│     → Tambah kas jika toggle on, kurangi jika toggle off │
│  5. Search anggota untuk pencarian                   │
│  6. Recap: "Total Terkumpul" + "Total Belum Bayar"   │
│                                                        │
│  SECTION 2: PENGELUARAN OPERASIONAL                  │
│  ────────────────────────────────────               │
│  1. Form Input:                                      │
│     • Kategori dropdown (Booking Lapang, Beli Barang, dll) │
│     • Nominal                                        │
│     • Keterangan                                     │
│     • Note Penalangan (untuk tracking menalangi)    │
│  2. Klik "Tambah Pengeluaran"                        │
│     ↓                                                 │
│     Insert ke `pengeluaran_operasional`              │
│     ↓        Innalilahi wa innailaihi rojiun...                                         │
│     Trigger: Kurangi saldo kas                       │
│     Trigger: Log ke audit_logs                       │
│  3. Toast: "Pengeluaran tercatat"                    │
│  4. List pengeluaran dengan edit/delete buttons      │
│                                                        │
│  SECTION 3: RINGKASAN KAS REAL-TIME                 │
│  ──────────────────────────────────                  │
│  • Card 1: Kas Terkumpul (dari KasAnggota bayar)     │
│  • Card 2: Total Pengeluaran (dari pengeluaran_operasional) │
│  • Card 3: Saldo Bersih (Pemasukan - Pengeluaran)   │
│                                                        │
│  All Cards auto-update lewat Livewire (#[Live])      │
│                                                        │
└────────────────────────────────────────────────────────┘
```

### 5.5 Flow: Update Status Kegiatan (Auto-Scheduler)

```
┌─ LARAVEL SCHEDULER (Every 5 minutes) ─────────────────┐
│                                                        │
│  Job: UpdateKegiatanStatusJob (app/Jobs/...)         │
│                                                        │
│  1. Check semua kegiatan berstatus 'published':       │
│     IF tanggal_mulai <= NOW()                        │
│       → Update status = 'ongoing'                    │
│                                                        │
│  2. Check semua kegiatan berstatus 'ongoing':        │
│     IF tanggal_selesai <= NOW()                      │
│       → Update status = 'completed'                  │
│                                                        │
│  3. Log setiap perubahan ke audit_logs               │
│                                                        │
│  Jalankan dengan: php artisan schedule:run           │
│  (set di cron job: * * * * * /usr/bin/php ...cli ... schedule:run) │
│                                                        │
└────────────────────────────────────────────────────────┘
```

---

## 6. MODULE SPECIFICATIONS

### 6.1 Anggota (Member Management)

**URL:** `/dashboard/anggota`\
**Permissions:** manage-anggota (Admin, Sie Absensi), view-anggota (Member view-only)\
**Access:** Super Admin, Admin, Sie Absensi (Bendahara CRUD), Pembina (View-only), Member (Own only)

**Features:**
- **List View (Table)**
  - Columns: No | Foto | NIS | Nama | Kelas | Status | Action (Edit/Delete)
  - Search: By NIS, Nama
  - Filter: By Status (Aktif/Nonaktif)
  - Pagination: 15 rows/page
  - Bulk Action: Delete multiple

- **Create/Edit Form**
  - Fields: NIS (unique), Nama, Kelas, Jurusan, Posisi, Status, Tanggal Bergabung
  - Validation: NIS not duplicate, status must be aktif/nonaktif
  - File Upload: Foto profil (optional)
  - On Create: Auto-generate User (if not exist) dengan NIS as username

- **Detail View**
  - Show: Full data + foto + riwayat kehadiran summary

- **Integration**
  - Link ke PendaftaranKegiatan (lihat kegiatan yang diikuti)
  - Link ke Absensi (lihat kehadiran)
  - Link ke Kas Anggota (lihat pembayaran)

**Livewire Component:**
- `app/Livewire/AnggotaTable.php` — List & delete
- `app/Livewire/AnggotaForm.php` — Create/Edit

---

### 6.2 Kegiatan (Activity Management)

**URL:** `/dashboard/kegiatan`\
**Permissions:** manage-kegiatan, view-kegiatan\
**Access:** Super Admin, Admin, Sie Absensi, Pembina (View-only), Member (View+Daftar public)

**Features:**
- **List View (Table)**
  - Columns: No | Foto | Judul | Tanggal | Kategori (badge) | Status | Kuota | Action
  - Search: By Judul, Deskripsi
  - Filter: By Status (draft/published/ongoing/completed/cancelled), Kategori
  - Pagination: 10 rows/page
  - Public View: Show only 'published' status

- **Create/Edit Form**
  - Fields: Judul, Deskripsi, Tanggal Mulai, Tanggal Selesai (optional), Lokasi, Kuota (optional), Kategori (dropdown: Latihan/Pertandingan/Seleksi/Gathering/Lainnya), Foto, Status
  - Validation: tanggal_selesai >= tanggal_mulai, kuota >= 1 if set
  - File Upload: Foto kegiatan (storage/app/public/kegiatan/)
  - Rich Text Editor: Deskripsi (optional)

- **Status Workflow**
  - draft → (publish) → published → (auto) → ongoing → (auto) → completed
  - Any → (manual) → cancelled

- **View Peserta**
  - List anggota yang terdaftar
  - Show status kehadiran per anggota (di-link ke Absensi)

- **Integration**
  - Observer: Auto-create KasKegiatan jika kategori='latihan' & status='published'
  - Scheduler: Auto-update status berdasarkan tanggal

**Livewire Component:**
- `app/Livewire/KegiatanTable.php`
- `app/Livewire/KegiatanForm.php`

---

### 6.3 Absensi (Attendance Management)

**URL:** `/dashboard/absensi`\
**Permissions:** manage-absensi, view-absensi\
**Access:** Super Admin, Admin, Sie Absensi (CRUD), Pembina (View), Member (Own only)

**Features:**
- **Bulk Input Interface**
  - Filter: Kegiatan (dropdown, default="Latihan"), Tanggal (date picker)
  - List: Show anggota terdaftar kegiatan tsb
  - Columns: No | Nama | NIS | Kelas | Status Kehadiran (dropdown) | Catatan
  - Status dropdown: Hadir, Izin, Sakit, Alpa
  - Save button: Save all changes

- **Quick Actions (Bulk)**
  - "Hadir Semua" → Set semua visible rows = Hadir
  - "Tidak Semua" → Set semua visible rows = Alpa
  - "Reset" → Clear semua absensi (kegiatan+tanggal tsb)
  - Confirm dialog sebelum reset

- **Recap View**
  - Table: Anggota | Total Kegiatan | Hadir | Persentase Kehadiran
  - Filter: By Anggota, By Kegiatan
  - Export: Excel (list absensi detail)

- **Member View**
  - Show-only: Riwayat absensi pribadi
  - Columns: Kegiatan | Tanggal | Status | Catatan
  - No edit/delete access

**Livewire Component:**
- `app/Livewire/AbsensiTable.php`
- Methods: markAllAsHadir(), markAllAsTidakHadir(), resetAll()

**Database Triggers:**
- Auto-log ke audit_logs setiap insert/update absensi

---

### 6.4 Keuangan (Financial Management)

**URL:** `/dashboard/keuangan`\
**Permissions:** manage-keuangan, view-keuangan\
**Access:** Super Admin, Admin, Bendahara (CRUD), Pembina (View), Member (Own only)

**Structure (Dual):**

**A. Kas Anggota (Iuran Latihan)**
- Tabel: KasAnggota (kegiatan_id, anggota_id, nominal_per_anggota, sudah_bayar)
- Default nominal: Rp 5.000 per anggota
- Observer: Auto-create saat kegiatan.kategori='latihan' dipublish
- UI: Toggle per anggota untuk mark as paid/unpaid
- Real-time update saldo kas via trigger

**B. Pengeluaran Operasional**
- Tabel: PengeluaranOperasional (kategori, nominal, keterangan, tanggal, note_penalangan)
- Kategori: Booking Lapang, Beli Barang, Bantu Teman/Menalangi, Lainnya
- Form: Create/Edit/Delete pengeluaran
- Note khusus: Track penalangan (siapa yang dibantui, berapa)

**C. Ringkasan Real-Time**
- Card: Kas Terkumpul, Total Pengeluaran, Saldo Bersih
- All cards update via #[Live] Livewire

**Livewire Component:**
- `app/Livewire/KeuanganTable.php` — Main interface
- Sections: KasAnggota, PengeluaranOperasional, Ringkasan

**Integration:**
- Trigger: Update saldo_kas saat toggle KasAnggota or create PengeluaranOperasional
- Dashboard: Show saldo_kas card real-time

---

### 6.5 Pengumuman (Announcement Management)

**URL:** `/dashboard/pengumuman` (Admin), `/pengumuman` (Public)\
**Permissions:** manage-pengumuman, publish-pengumuman\
**Access:** Super Admin, Admin, Sie Absensi (CRUD), Bendahara (CRUD), Pembina (View), Member (View), Guest (View published)

**Features:**
- **Admin List View**
  - Columns: No | Judul | Status | Kategori | Is Pinned | Tanggal Publish | Action
  - Filter: By Status (draft/published), By Kategori (Penting/Info/Prestasi/Lainnya)
  - Search: By Judul
  - Bulk: Delete, Publish, Unpublish

- **Create/Edit Form**
  - Fields: Judul, Isi (rich text), Status (draft/published), Kategori, Foto, Is Pinned checkbox, Tanggal Publish
  - Validation: Judul required, min 10 chars
  - File Upload: Foto pengumuman (optional)

- **Public View**
  - Show only status='published' pengumuman
  - Pinned items first (is_pinned=true)
  - Pagination: 5 per page
  - Detail: Click title → show full content + foto

**Livewire Component:**
- `app/Livewire/PengumumanTable.php`
- `app/Livewire/PengumumanForm.php`

---

### 6.6 Pendaftar Anggota Baru (New Member Registration)

**URL:** `/dashboard/pendaftar-baru` (Admin), `/pendaftar-anggota` (Public form)\
**Permissions:** manage-anggota (for approval)\
**Access:** Super Admin, Admin, Sie Absensi (Approve), Pembina (View), Guest (Submit)

**Features:**

**A. Public Form** (`/pendaftar-anggota`)
- Fields: Nama, NIS (unique validation), Kelas, Kontak (WA/email), Alasan Gabung, Submit Button
- No auth required
- Validation: NIS not duplicate, format check
- Success message: "Terima kasih, data Anda sedang direview"

**B. Admin Approval** (`/dashboard/pendaftar-baru`)
- List: Pending pendaftaran anggota
- Columns: No | Nama | NIS | Kelas | Kontak | Alasan Gabung | Action (Approve/Reject)
- Filter: By Status (Pending/Approved/Rejected)
- Approve button:
  - Trigger: sp_approve_pendaftaran_anggota (create User + Anggota)
  - Show password awal (1x only) untuk diberitahu ke calon anggota
  - Set force_password_change=true
- Reject button:
  - Form: Alasan penolakan (optional)
  - Update status = 'rejected'

- Reject Modal:
  - Ask for rejection reason (text)
  - Save ke pendaftaran_anggota.alasan_ditolak

**Livewire Component:**
- `app/Livewire/PendaftaranAnggotaTable.php` (Admin view)
- Blade Form: `resources/views/pages/pendaftar-anggota.blade.php` (Public)

---

### 6.7 Dashboard (Role-Specific Home)

**URL:** `/dashboard`\
**Access:** Authenticated users only (role-based metrics)

**For Super Admin / Admin:**
- Card 1: Total Anggota Aktif
- Card 2: Total Kegiatan Aktif (status: published, ongoing)
- Card 3: Tingkat Kehadiran (rata-rata %)
- Card 4: Saldo Kas (from fn_saldo_kas_current())
- Card 5: Pendaftar Baru (pending count)
- Chart: Absensi trend (last 7 days)
- Chart: Kas trend (last 30 days)

**For Bendahara:**
- Card: Saldo Kas
- Card: Kas Terkumpul Bulan Ini
- Card: Pengeluaran Bulan Ini
- Table: Recent Transaksi Kas
- Chart: Kas trend

**For Sie Absensi:**
- Card: Total Kegiatan
- Card: Total Peserta Aktif
- Card: Tingkat Kehadiran
- Table: Kegiatan hari ini + anggota hadir
- Chart: Absensi per kegiatan

**For Pembina:**
- Same as Admin (view-only, no edit buttons)

**For Member:**
- Card: Kegiatan Terdaftar
- Card: Tingkat Kehadiran Personal
- Card: Status Pembayaran Kas
- Table: Riwayat Kehadiran (5 recent)
- Table: Kegiatan Mendatang

**Livewire Component:**
- `app/Http/Controllers/DashboardController.php`
- Real-time metrics via #[Live] properties

---

### 6.8 Laporan & Export

**URL:** `/dashboard/laporan` (View), `/dashboard/*/export` (Download)\
**Permissions:** view-laporan, export-laporan\
**Access:** Super Admin, Admin, Sie Absensi, Bendahara, Pembina (View)

**Features:**
- **Laporan Absensi**
  - Export: Excel (app/Exports/AbsensiExport.php)
  - Filter: By Kegiatan, By Range Tanggal
  - Columns: No | Anggota | NIS | Kegiatan | Tanggal | Status | Catatan

- **Laporan Keuangan**
  - Export: Excel (app/Exports/KeuanganExport.php)
  - Filter: By Jenis (Pemasukan/Pengeluaran), By Range Tanggal, By Kategori
  - Columns: No | Tanggal | Jenis | Kategori | Nominal | Keterangan | Pembuat

- **Laporan Kehadiran Per Anggota**
  - Export: PDF (via DomPDF)
  - Show: Nama | Total Kegiatan | Total Hadir | Persentase | Status

**Controllers:**
- `app/Http/Controllers/ExportController.php`
- Methods: exportAbsensi(), exportKeuangan(), exportLaporan()

**Routes:**
- GET `/dashboard/absensi/export` → trigger Excel download
- GET `/dashboard/keuangan/export` → trigger Excel download
- GET `/dashboard/laporan/pdf` → trigger PDF download

---

### 6.9 User & Role Management (Super Admin Only)

**URL:** `/dashboard/users`, `/dashboard/roles`\
**Permissions:** manage-users, manage-roles, manage-permissions\
**Access:** Super Admin only

**Features:**

**A. User Management**
- List: All users + current role
- Create: Manual create user + assign role
- Edit: Change user email, reset password, change role
- Delete: Remove user + cascade anggota (if linked)

**B. Role Management**
- List: All roles (built-in + custom)
- Create: Custom role
- Edit: Rename, change permissions
- Assign: Link permissions to role

**Livewire Component:**
- `app/Livewire/UserTable.php`
- `app/Livewire/RoleTable.php`

---

## 7. ADMIN DASHBOARD COMPONENTS

### 7.1 Sidebar Navigation (Dynamic per Role)

```
Struktur Menu:

┌─ DASHBOARD
│
├─ ANGGOTA
│  └── Daftar Anggota
│  └── Pendaftar Baru (badge: count pending) [visibility: Super Admin, Admin, Sie Absensi]
│
├─ KEGIATAN
│  └── Daftar Kegiatan
│  └── Pendaftaran Kegiatan
│
├─ ABSENSI [visibility: Super Admin, Admin, Sie Absensi]
│  └── Input Absensi
│  └── Rekap Absensi
│
├─ KEUANGAN [visibility: Super Admin, Admin, Bendahara]
│  └── Manajemen Kas
│
├─ PENGUMUMAN
│  └── Daftar Pengumuman
│
├─ LAPORAN [visibility: Super Admin, Admin, Sie Absensi, Bendahara]
│  └── Export Absensi
│  └── Export Keuangan
│
├─ USER & ROLE [visibility: Super Admin only]
│  └── Manajemen User
│  └── Manajemen Role & Permission
│
└─ SETTINGS
   └── Profil
   └── Ganti Password
   └── Logout
```

**Livewire Component:**
- `resources/views/livewire/sidebar.blade.php` — Dynamic menu per role
- Badge real-time: Pendaftar Baru count via #[Live]

### 7.2 Navbar (Top Bar)

```
┌─────────────────────────────────────────────────┐
│ Menu ☰ | Logo | Breadcrumb | 🔔 | 🌙/☀️ | 👤 |
└─────────────────────────────────────────────────┘

Fungsi:
- Menu ☰: Toggle sidebar (mobile)
- Logo: Click → back to dashboard
- Breadcrumb: Show current page hierarchy
- 🔔 (Bell): Notification icon (future feature)
- 🌙/☀️: Dark mode toggle (saves to session)
- 👤 (Avatar): Click → dropdown (Profil, Logout)
```

**Livewire Component:**
- `resources/views/livewire/navbar.blade.php`
- Dark/light mode toggle (affects entire app via Tailwind dark: prefix)

### 7.3 Table Components (Reusable)

**Standard Features:**
- Search (live, debounced)
- Filter (multiple columns)
- Sort (asc/desc per column)
- Pagination (15 rows default)
- Bulk actions (select checkbox)
- Responsive (horizontal scroll on mobile)

**Styling:**
- Light theme: White background, dark text (default)
- Dark theme: Gray-900 background, gray-300 text (for sensitive data like Keuangan)
- Dark mode toggle: Applies `dark:` classes site-wide

**Blade Component Template:**
```blade
<div class="table-wrapper dark:bg-gray-900">
  <table class="min-w-full dark:text-gray-300">
    <thead class="dark:bg-gray-800">
      <tr>
        <th class="dark:border-gray-700">Column 1</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr class="dark:border-gray-700 dark:hover:bg-gray-800">
          <td>{{ $item->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
```

### 7.4 Form Components (Reusable)

**Standard Features:**
- Real-time validation
- Error message display
- File upload preview
- Rich text editor (optional)
- Loading state (disabled button)
- Success/error toast notification

**Blade Component Example:**
```blade
<form wire:submit.prevent="save">
  <div class="form-group">
    <label>Nama</label>
    <input type="text" wire:model.live="form.nama" class="form-control dark:bg-gray-800">
    <error>{{ $errors->first('form.nama') }}</error>
  </div>
  
  <button type="submit" wire:loading.attr="disabled">
    <span wire:loading.remove>Simpan</span>
    <span wire:loading>Menyimpan...</span>
  </button>
</form>
```

### 7.5 Alert & Toast Components

**Alert (dismissible notifications at top of page):**
```blade
<div wire:model.debounce.2000="showAlert" 
     class="alert alert-{{ $alertType }} dark:alert-dark-{{ $alertType }}">
  {{ $alertMessage }}
</div>
```

**Toast (small notifications, auto-dismiss):**
```php
// In Livewire component
$this->dispatch('notify', 
  message: 'Data berhasil disimpan',
  type: 'success'
);
```

### 7.6 Modal Components

**Confirmation Modal (Delete, Reject, Reset):**
```blade
<div wire:model.live="showConfirmModal" class="modal">
  <h3>{{ $confirmTitle }}</h3>
  <p>{{ $confirmMessage }}</p>
  <button wire:click="confirmAction">Ya, {{ $confirmAction }}</button>
  <button wire:click="cancelAction">Batal</button>
</div>
```

---

## 8. API ROUTES & ENDPOINTS

### 8.1 Public Routes (No Auth)

```php
// resources/views/pages/
GET  /                          → Home page
GET  /tentang                   → About page
GET  /kegiatan                  → List kegiatan (published only)
GET  /kegiatan/{id}             → Detail kegiatan
GET  /pengumuman                → List pengumuman (published only)
GET  /pengumuman/{id}           → Detail pengumuman
GET  /pendaftar-anggota         → Form pendaftaran anggota baru
POST /pendaftar-anggota         → Submit form (handle in Livewire or Controller)
GET  /auth/login                → Login page
POST /auth/login                → Authenticate user (Breeze standard)
```

### 8.2 Admin Dashboard Routes (Auth Required, Role-Based)

```php
// routes/web.php with middleware: auth, verified

// Dashboard
GET  /dashboard                 → DashboardController@index (role-specific)

// Anggota
GET  /dashboard/anggota                        → AnggotaTable component
POST /dashboard/anggota                        → Store (via Livewire)
PUT  /dashboard/anggota/{id}                   → Update (via Livewire)
DELETE /dashboard/anggota/{id}                 → Delete (via Livewire)

// Kegiatan
GET  /dashboard/kegiatan                       → KegiatanTable component
POST /dashboard/kegiatan                       → Store
PUT  /dashboard/kegiatan/{id}                  → Update
DELETE /dashboard/kegiatan/{id}                → Delete

// Pendaftaran Kegiatan
GET  /dashboard/kegiatan/{kegiatan_id}/peserta → List peserta per kegiatan

// Absensi
GET  /dashboard/absensi                        → AbsensiTable component
POST /dashboard/absensi                        → Bulk save (via Livewire)
DELETE /dashboard/absensi/{id}                 → Delete single

// Keuangan
GET  /dashboard/keuangan                       → KeuanganTable component
POST /dashboard/keuangan/kas-anggota           → Toggle kas anggota bayar
POST /dashboard/keuangan/pengeluaran           → Add pengeluaran
PUT  /dashboard/keuangan/pengeluaran/{id}      → Edit pengeluaran
DELETE /dashboard/keuangan/pengeluaran/{id}    → Delete pengeluaran

// Pengumuman
GET  /dashboard/pengumuman                     → PengumumanTable component
POST /dashboard/pengumuman                     → Store
PUT  /dashboard/pengumuman/{id}                → Update
DELETE /dashboard/pengumuman/{id}              → Delete

// Pendaftar Anggota Baru
GET  /dashboard/pendaftar-baru                 → PendaftaranAnggotaTable component
POST /dashboard/pendaftar-baru/{id}/approve    → Approve + create user/anggota
POST /dashboard/pendaftar-baru/{id}/reject     → Reject + save alasan

// Laporan & Export
GET  /dashboard/absensi/export                 → ExportController@exportAbsensi (download Excel)
GET  /dashboard/keuangan/export                → ExportController@exportKeuangan (download Excel)
GET  /dashboard/laporan/pdf                    → ExportController@exportLaporan (download PDF)

// User & Role (Super Admin only)
GET  /dashboard/users                          → UserTable component
GET  /dashboard/roles                          → RoleTable component
POST /dashboard/users                          → Store user
PUT  /dashboard/users/{id}                     → Update user
DELETE /dashboard/users/{id}                   → Delete user

// Settings
GET  /dashboard/settings                       → Settings page
POST /dashboard/settings/profile               → Update profile
POST /dashboard/settings/password              → Change password
```

### 8.3 Livewire AJAX Requests (Implicit)

Semua Livewire component secara otomatis mengirim request AJAX saat:
- `wire:model` update (form input change)
- `wire:click` action (button click)
- `wire:submit` form submit

Contoh:
```blade
<!-- This triggers AJAX POST automatically -->
<input type="text" wire:model.live="search">

<!-- This triggers AJAX POST -->
<button wire:click="deleteItem({{ $item->id }})">Hapus</button>

<!-- This triggers AJAX POST -->
<form wire:submit.prevent="saveForm">...</form>
```

---

## 9. KEY TECHNICAL IMPLEMENTATIONS

### 9.1 Database Triggers (Auto-Sync)

```sql
-- Trigger 1: Auto-update saldo_kas saat toggle KasAnggota
CREATE TRIGGER tg_kas_anggota_sync
AFTER UPDATE ON kas_anggota
FOR EACH ROW
BEGIN
  IF NEW.sudah_bayar = 1 THEN
    UPDATE transaksi_kas SET nominal = nominal + NEW.nominal_per_anggota
    WHERE kategori = 'Kas Anggota' AND referensi_id = NEW.id;
  END IF;
END;

-- Trigger 2: Auto-insert audit_logs saat absensi insert/update
CREATE TRIGGER tg_audit_absensi
AFTER INSERT ON absensi
FOR EACH ROW
BEGIN
  INSERT INTO audit_logs (action, model, model_id, new_values, created_at)
  VALUES ('insert', 'Absensi', NEW.id,
          JSON_OBJECT('status_kehadiran', NEW.status_kehadiran),
          NOW());
END;
```

### 9.2 Observers (Laravel Auto-Sync)

```php
// app/Observers/KegiatanObserver.php
public function created(Kegiatan $kegiatan) {
  // Auto-create KasKegiatan jika kategori='latihan' & status='published'
  if ($kegiatan->kategori === 'latihan' && $kegiatan->status === 'published') {
    KasKegiatan::create([
      'kegiatan_id' => $kegiatan->id,
      'nominal_per_anggota' => 5000,
    ]);
  }
}

// app/Observers/PendaftaranKegiatanObserver.php
public function created(PendaftaranKegiatan $pendaftaran) {
  // Auto-create KasAnggota saat anggota daftar latihan
  if ($pendaftaran->kegiatan->kategori === 'latihan') {
    KasAnggota::create([
      'kegiatan_id' => $pendaftaran->kegiatan_id,
      'anggota_id' => $pendaftaran->anggota_id,
      'nominal_per_anggota' => 5000,
      'sudah_bayar' => false,
    ]);
  }
}

// app/Observers/AbsensiObserver.php
public function created(Absensi $absensi) {
  // Optional: Update target_total based on attendance count
  $totalHadir = Absensi::where('kegiatan_id', $absensi->kegiatan_id)
    ->where('status_kehadiran', 'hadir')
    ->count();
  
  // Update some metric (if needed)
}
```

### 9.3 Livewire Component Lifecycle

```php
class AbsensiTable extends Component {
  #[Validate('required|integer')]
  public $kegiatan_id;
  
  #[Validate('required|date')]
  public $tanggal;
  
  public $absensiData = [];
  
  // Mount: Initialize component
  public function mount() {
    $this->authorize('manage-absensi');
    $this->kegiatan_id = Kegiatan::where('status', 'latihan')->first()->id;
    $this->loadAbsensi();
  }
  
  // Updated hook: Listen for changes
  #[On('updated:kegiatan_id')]
  public function updatedKegiatanId() {
    $this->loadAbsensi();
  }
  
  // Live property: Real-time reaction
  #[Live]
  public $search = '';
  
  // Computed property: Derived data
  #[Computed]
  public function filteredAbsensi() {
    return $this->absensiData->filter(...);
  }
  
  // Action method: Respond to user action
  public function markAllAsHadir() {
    foreach ($this->absensiData as &$item) {
      $item['status'] = 'hadir';
    }
    $this->dispatch('notify', message: 'Semua mark hadir');
  }
  
  // Save method
  public function saveAbsensi() {
    DB::transaction(function () {
      foreach ($this->absensiData as $item) {
        Absensi::updateOrCreate(
          ['pendaftaran_kegiatan_id' => $item['id']],
          ['status_kehadiran' => $item['status']]
        );
      }
    });
    $this->dispatch('notify', message: 'Absensi tersimpan');
  }
  
  // Render
  public function render() {
    return view('livewire.absensi-table', [
      'absensi' => $this->absensiData,
    ]);
  }
  
  private function loadAbsensi() {
    $this->absensiData = PendaftaranKegiatan::where('kegiatan_id', $this->kegiatan_id)
      ->with('anggota', 'absensi')
      ->get()
      ->toArray();
  }
}
```

### 9.4 Policy & Authorization

```php
// app/Policies/AbsensiPolicy.php
class AbsensiPolicy {
  use HandlesAuthorization;
  
  public function viewAny(User $user) {
    return $user->can('view-absensi');
  }
  
  public function view(User $user, Absensi $absensi) {
    // Super Admin dapat akses semua
    if ($user->hasRole('Super Admin')) return true;
    
    // Admin dengan permission manage-absensi dapat akses
    if ($user->can('manage-absensi')) return true;
    
    // Member hanya bisa lihat absensi pribadi
    return $absensi->pendaftaran_kegiatan->anggota->user_id === $user->id;
  }
  
  public function update(User $user, Absensi $absensi) {
    return $user->can('manage-absensi');
  }
}

// Gate di Livewire
class AbsensiTable extends Component {
  public function mount() {
    $this->authorize('viewAny', Absensi::class);
  }
}
```

### 9.5 Export Feature

```php
// app/Exports/AbsensiExport.php
class AbsensiExport implements FromQuery, WithHeadings, WithStyles {
  private $kegiatanId;
  private $startDate;
  private $endDate;
  
  public function __construct($kegiatanId, $startDate, $endDate) {
    $this->kegiatanId = $kegiatanId;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
  }
  
  public function query() {
    return Absensi::with('pendaftaranKegiatan', 'pendaftaranKegiatan.anggota')
      ->whereBetween('created_at', [$this->startDate, $this->endDate])
      ->when($this->kegiatanId, fn($q) => $q->where('kegiatan_id', $this->kegiatanId));
  }
  
  public function headings(): array {
    return ['No', 'Nama Anggota', 'NIS', 'Kegiatan', 'Tanggal', 'Status', 'Catatan'];
  }
  
  public function styles(Worksheet $sheet) {
    return [
      1 => ['font' => ['bold' => true], 'fill' => ['fgColor' => ['argb' => 'FFD3D3D3']]],
    ];
  }
}

// Use in ExportController
public function exportAbsensi(Request $request) {
  return Excel::download(
    new AbsensiExport($request->kegiatan_id, $request->start_date, $request->end_date),
    'absensi_' . now()->format('Y-m-d') . '.xlsx'
  );
}
```

### 9.6 Dark Mode Implementation

```blade
<!-- In navbar.blade.php -->
<button @click="darkMode = !darkMode" wire:click="toggleDarkMode">
  <span x-show="!darkMode">🌙</span>
  <span x-show="darkMode">☀️</span>
</button>

<!-- Session/Cookie storage -->
@php
$darkMode = session('dark_mode', false);
@endphp

<html @if($darkMode) class="dark" @endif>
  <body class="dark:bg-gray-900 dark:text-gray-300">
    <!-- Content -->
  </body>
</html>
```

---

## 10. DEPLOYMENT & FINAL CHECKLIST

### 10.1 Pre-Deployment Checklist

- [ ] **Database**
  - [ ] All migrations run (`php artisan migrate`)
  - [ ] All seeds executed (`php artisan db:seed`)
  - [ ] Triggers created manually (or via migration)
  - [ ] Functions created
  - [ ] Backup strategy in place

- [ ] **Application**
  - [ ] ENV file configured (.env.production)
  - [ ] APP_KEY generated (`php artisan key:generate`)
  - [ ] APP_DEBUG=false
  - [ ] QUEUE_DRIVER set correctly
  - [ ] MAIL_* configured (if notif via email)
  - [ ] FILESYSTEM_DISK set to 'public' for storage

- [ ] **Cron Jobs**
  - [ ] Scheduler job configured: `UpdateKegiatanStatusJob` (runs every 5 min)
  - [ ] Crontab entry: `* * * * * /usr/bin/php /path/to/app/artisan schedule:run`

- [ ] **Assets**
  - [ ] CSS/JS built: `npm run build`
  - [ ] Storage symlink created: `php artisan storage:link`
  - [ ] Permissions set: `chmod -R 755 storage bootstrap/cache`

- [ ] **Testing**
  - [ ] Unit tests pass: `php artisan test`
  - [ ] All CRUD pages tested manually (all roles)
  - [ ] Dark/light mode toggle tested
  - [ ] Export functionality tested (download Excel/PDF)
  - [ ] Role-based access tested (member gets 403 on admin pages)
  - [ ] Bulk actions tested (Absensi markAllAsHadir, etc.)

- [ ] **Security**
  - [ ] SQL Injection tested (parameterized queries)
  - [ ] XSS tested (escaped output)
  - [ ] CSRF token in all forms
  - [ ] Password validation (min 8 chars, alphanumeric)
  - [ ] Rate limiting on form submissions

- [ ] **Performance**
  - [ ] Database indexes created
  - [ ] Queries optimized (eager loading with `->with()`)
  - [ ] Cache configured (Redis / Memcached)
  - [ ] Pagination set reasonably (not loading all rows)

### 10.2 Deployment Steps

1. **Prepare Server**
   ```bash
   # SSH to production server
   cd /var/www/sibasket
   
   # Pull latest code
   git pull origin master
   
   # Install dependencies
   composer install --no-dev
   
   # Install JS dependencies
   npm install --production
   ```

2. **Database Migration**
   ```bash
   # Backup current DB first!
   php artisan migrate --env=production
   
   # Run seeders (if needed for static data)
   php artisan db:seed --class=RolePermissionSeeder
   ```

3. **Build & Setup**
   ```bash
   php artisan key:generate
   php artisan cache:clear
   php artisan config:cache
   php artisan view:cache
   php artisan route:cache
   
   npm run build
   
   php artisan storage:link
   chmod -R 755 storage bootstrap/cache
   ```

4. **Cron Job**
   ```bash
   # Add to crontab
   crontab -e
   # Insert: * * * * * /usr/bin/php /var/www/sibasket/artisan schedule:run
   ```

5. **Verify**
   ```bash
   # Test app is accessible
   curl https://sibasket.example.com
   
   # Check logs for errors
   tail -f storage/logs/laravel.log
   
   # Manual smoke test:
   # - Login as each role
   # - Test CRUD operations
   # - Check Dashboard metrics load
   # - Try export Excel
   ```

### 10.3 Post-Deployment Monitoring

- **Log Monitoring**
  ```bash
  tail -f /var/www/sibasket/storage/logs/laravel.log
  tail -f /var/log/nginx/sibasket.error.log
  ```

- **Database Monitoring**
  - Monitor disk space usage
  - Check query performance
  - Verify triggers/procedures still intact

- **User Feedback**
  - Gather feedback from Super Admin / Bendahara
  - Fix bugs immediately (hotfix branch)
  - Document any issues in `12-changelog-dan-notes.md`

### 10.4 Rollback Plan

If deployment fails:
```bash
git revert HEAD --no-edit
git push origin master

# Or rollback database
php artisan migrate:rollback --steps=1

# Clear cache
php artisan cache:clear
```

---

## APPENDIX: Quick Reference

### File Structure
```
sibasket/
├── app/
│   ├── Http/Controllers/         # Request handlers
│   ├── Livewire/                 # Livewire components
│   ├── Models/                   # Eloquent models
│   ├── Policies/                 # Authorization
│   ├── Exports/                  # Excel exports
│   ├── Observers/                # Model observers
│   └── Jobs/                     # Scheduled jobs
├── database/
│   ├── migrations/               # Schema changes
│   ├── seeders/                  # Initial data
│   └── factories/                # Test data
├── resources/
│   ├── views/
│   │   ├── livewire/             # Livewire component templates
│   │   ├── pages/                # Public pages
│   │   └── layouts/              # Base layouts
│   └── css/                      # Tailwind CSS
├── routes/
│   ├── web.php                   # Web routes
│   └── console.php               # Artisan commands
├── config/
│   └── permission.php            # Spatie config
└── tests/                        # Unit & feature tests
```

### Common Artisan Commands

```bash
# Generate new migration
php artisan make:migration create_kegiatan_table

# Generate Livewire component
php artisan make:livewire KegiatanTable

# Generate model + migration
php artisan make:model Kegiatan -m

# Generate controller
php artisan make:controller KegiatanController

# Generate policy
php artisan make:policy KegiatanPolicy --model=Kegiatan

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Run tests
php artisan test

# Optimize (for production)
php artisan optimize
```

### Validation Rules Used

```php
// Common validations across project
[
  'nis' => 'required|string|max:20|unique:anggota,nis',
  'nama' => 'required|string|max:100',
  'email' => 'required|email|unique:users,email',
  'status_kehadiran' => 'required|in:hadir,izin,sakit,alpa',
  'nominal' => 'required|numeric|min:0',
  'tanggal_mulai' => 'required|date',
  'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
  'kuota' => 'nullable|integer|min:1',
]
```

---

## RINGKASAN EKSEKUTIF

**SIBASKET** adalah aplikasi manajemen Eskul Basket built dengan Laravel 11 + Livewire 3 yang mengintegrasikan:

1. **Database Layer** — Terstruktur dengan Triggers, Stored Procedures, Functions untuk konsistensi data dan auto-sync
2. **Role-Based Admin Dashboard** — 5 role dengan permissions granular, sidebar dinamis, real-time metrics
3. **Core Modules** — Anggota (CRUD), Kegiatan (workflow), Absensi (bulk), Keuangan (dual structure), Pengumuman, Pendaftar Baru (approval flow)
4. **Public Website** — Landing page, jadwal kegiatan, pengumuman, form pendaftaran guest
5. **Reporting & Export** — Excel/PDF exports dengan filter date-range & kategori
6. **Dark Mode** — Full support across all pages with Tailwind dark: prefix
7. **Observers & Auto-Sync** — Laravel observers untuk auto-create kas, audit logging, cascade updates

**Tujuan prompt ini:** Memberikan AI lain (atau developer lain) gambaran LENGKAP tentang architecture, database design, business flows, dan implementasi technical sehingga mereka bisa:
- Lanjutkan development phase berikutnya
- Extend fitur dengan consistency terjaga
- Fix bugs dengan understanding konteks penuh
- Deploy dengan confidence

**Status:** MVP 96% complete, siap production. Tinggal final smoke test & deploy.

---

**End of Master Prompt**
