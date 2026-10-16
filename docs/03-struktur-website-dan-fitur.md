# 📱 Struktur Website & Fitur SiBasket

**Dokumentasi Lengkap:** Desain Website, User Flow, dan Features

**Last Updated:** Oct 16, 2026

---

## 🎯 Overview

SiBasket adalah sistem manajemen klub basket terintegrasi dengan akses berbasis role (Super Admin, Admin, Pembina, Member). Website terbagi menjadi 2 bagian utama:
1. **Public Pages** — Untuk umum (tanpa login)
2. **Protected Pages** — Untuk pengguna yang sudah login (dengan permission checks)

---

## 🌐 PUBLIC PAGES (Tidak Perlu Login)

### Navbar Publik
```
[SiBasket Logo] | Beranda | Kegiatan | Pengumuman | [Login Button]
```

**Navigation Items:**
- **Beranda** → `/` (Landing page)
- **Kegiatan** → `/kegiatan-publik` (Daftar kegiatan)
- **Pengumuman** → `/pengumuman-publik` (Daftar pengumuman)
- **Login** → `/login` (Hanya muncul jika belum auth)
- **Dashboard** → `/dashboard` (Hanya muncul jika sudah auth)

---

### Public Pages Tersedia

#### 1. **Beranda (`/`)**
- Hero section dengan tagline
- 6 fitur utama dalam grid cards
- CTA buttons:
  - Jika **belum login:** "Login Sekarang" + "Lihat Kegiatan"
  - Jika **sudah login:** "Ke Dashboard"

**Content Grid:**
```
🎯 6 Feature Cards:
1. 👥 Manajemen Anggota
2. 🏀 Kegiatan & Pendaftaran
3. 📊 Manajemen Keuangan
4. ✅ Rekap Absensi
5. 📢 Pengumuman
6. 🔒 Kontrol Akses
```

#### 2. **Kegiatan Publik (`/kegiatan-publik`)**
- Daftar semua kegiatan aktif
- Setiap card menampilkan:
  - Judul kegiatan
  - Tanggal & lokasi
  - Deskripsi singkat
  - Tombol "Lihat Detail"

#### 3. **Detail Kegiatan (`/kegiatan/{id}`)**
- Info lengkap kegiatan
- **Jika belum login:** Tampil pesan + tombol "Login untuk Daftar"
- **Jika sudah login:** Tombol "Daftar Kegiatan" (untuk Member)

#### 4. **Pengumuman Publik (`/pengumuman-publik`)**
- Daftar pengumuman terbaru
- Setiap item menampilkan:
  - Judul
  - Tanggal publish
  - Isi preview
  - Tombol "Baca Selengkapnya"

---

## 🔐 LOGIN SYSTEM

### Login Flow

**Step 1:** User klik tombol **"Login"** di navbar publik

**Step 2:** Redirect ke `/login` — Form login:
```
┌─────────────────────┐
│  LOGIN SiBasket     │
├─────────────────────┤
│ Email:              │
│ [________________]  │
│                     │
│ Password:           │
│ [________________]  │
│                     │
│ [Login Button]      │
│ Belum punya akun?   │
│ [Daftar]            │
└─────────────────────┘
```

**Step 3:** Validasi
- ✅ **Credentials benar** → Redirect ke `/dashboard`
- ❌ **Credentials salah** → Tampil error message, tetap di halaman login
- ❌ **Email tidak terdaftar** → Error message

**Berlaku untuk:** Semua role (Admin, Pembina, Member) menggunakan form yang sama. Perbedaan hanya pada permission setelah login.

---

## 📊 DASHBOARD (After Login)

### Layout Dashboard

```
┌──────────────────────────────────────────────────┐
│ [Logo] SiBasket          [Avatar] ▼ (Logout)    │  ← Navbar
├──────────────────────────────────────────────────┤
│                                                  │
│  [SIDEBAR]    │  [MAIN CONTENT]                 │
│  - Dashboard  │                                  │
│  - Menus...   │  (Role-specific content)        │
│               │                                  │
│               │                                  │
└──────────────────────────────────────────────────┘
```

### Navbar Dashboard

**Top Navbar:**
- Logo + Brand name "SiBasket" (kiri)
- User avatar dropdown (kanan)
  - Profile (link ke `/profile/edit`)
  - Settings
  - Logout

---

### Sidebar Menu (Role-Based)

#### **SUPER ADMIN - Full Access**
```
🏠 Dashboard
👥 Manajemen Anggota
🏀 Kegiatan
📝 Pendaftaran Kegiatan
✅ Absensi
💰 Keuangan
📢 Pengumuman
📊 Laporan Keuangan
🔐 Role & Permission ← Super Admin Only
📤 Export Data
```

#### **ADMIN - Mengelola Semua**
```
🏠 Dashboard
👥 Manajemen Anggota
🏀 Kegiatan
📝 Pendaftaran Kegiatan
✅ Absensi
💰 Keuangan (+ Export ✨)
📢 Pengumuman
📊 Laporan Keuangan
```

#### **PEMBINA - Read-Only + Export**
```
🏠 Dashboard
👥 Lihat Anggota
🏀 Lihat Kegiatan
📝 Lihat Pendaftaran
✅ Lihat Absensi (+ Export ✨)
💰 Lihat Keuangan (+ Export ✨)
📢 Lihat Pengumuman
📊 Laporan Keuangan
```

#### **MEMBER - Limited Access**
```
🏠 Dashboard (Personal)
🏀 Lihat Kegiatan Tersedia
📝 Daftar Kegiatan
✅ Riwayat Absensi
💰 Riwayat Pembayaran
📢 Pengumuman
```

---

## 📈 DASHBOARD CONTENT BY ROLE

### ADMIN Dashboard

```
┌─────────────────────────────────────────────────────────┐
│ Dashboard - Selamat Datang, Admin!                      │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  📊 DASHBOARD METRICS (4 Cards):                       │
│  ┌──────────────┬──────────────┬───────────┬─────────┐ │
│  │ 👥 45        │ 🏀 8         │ ✅ 87%    │ 💰 5M   │ │
│  │ Total Angg.  │ Kegiatan Aktif│ Kehadiran│ Saldo  │ │
│  └──────────────┴──────────────┴───────────┴─────────┘ │
│                                                         │
│  📋 RECENT ACTIVITY / QUICK STATS:                     │
│  - Kegiatan terbaru                                    │
│  - Transaksi terakhir                                  │
│  - Absensi terbaru                                     │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

### MEMBER Dashboard

```
┌─────────────────────────────────────────────────────────┐
│ Dashboard - Halo, Member!                               │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  📊 STATISTIK PERSONAL (3 Cards):                      │
│  ┌──────────────┬──────────────┬──────────────────┐    │
│  │ ✅ 20/25     │ 💰 500K      │ 🏀 5             │    │
│  │ Kehadiran    │ Tanggungan    │ Kegiatan Terdaftar│   │
│  │ (80%)        │              │                  │    │
│  └──────────────┴──────────────┴──────────────────┘    │
│                                                         │
│  📋 QUICK LINKS:                                       │
│  - Kegiatan terbaru yang bisa didaftar                 │
│  - Pengumuman penting                                  │
│  - Riwayat pembayaran                                  │
│                                                         │
└─────────────────────────────────────────────────────────┘
```

### PEMBINA Dashboard

```
Read-Only Dashboard:
- Lihat Anggota (statistics only)
- Lihat Kegiatan (view)
- Lihat Pendaftaran (view)
- Lihat Absensi (view + Export Excel ✨)
- Lihat Keuangan (view + Export Excel ✨)
- Lihat Pengumuman (view)
- Laporan Keuangan (analytics)
```

---

## 🎛️ ADMIN PAGES DENGAN CRUD

### 1. **Manajemen Anggota** (`/dashboard/anggota`)

**Table Layout:**
```
┌─────────────────────────────────────────────────┐
│ Manajemen Anggota                               │
│ [+ Tambah Anggota]                              │
├─────────────────────────────────────────────────┤
│ [Search]                                        │
├─────────────────────────────────────────────────┤
│ No | Nama    | NIS | Kelas | Jurusan | Aksi   │
├─────────────────────────────────────────────────┤
│ 1  | Budi    | 001 | 10A   | PPLG    | ✏️ 🗑️  │
│ 2  | Ani     | 002 | 10B   | PPLG    | ✏️ 🗑️  │
│ 3  | Citra   | 003 | 10A   | MM      | ✏️ 🗑️  │
└─────────────────────────────────────────────────┘
```

**Actions:**
- ✏️ Edit → `/dashboard/anggota/{id}/edit`
- 🗑️ Delete → Modal confirm
- ➕ Tambah → `/dashboard/anggota/create`

---

### 2. **Manajemen Keuangan** (`/dashboard/keuangan`)

**Features:**
```
┌─────────────────────────────────────────────────┐
│ Manajemen Keuangan                              │
│ [Search: nama/kategori] [Jenis ▼] [Status ▼]   │
│ [+ Tambah] [📥 Export Excel] ← NEW! ✨          │
├─────────────────────────────────────────────────┤
│ Tgl        | Anggota | Jenis | Kategori | Aksi│
├─────────────────────────────────────────────────┤
│ 15-10-26   | Budi    | Masuk | Iuran    | ✏️  │
│ 14-10-26   | Ani     | Keluar| Hadiah   | ✏️  │
└─────────────────────────────────────────────────┘
```

**Export Excel Features (NEW):**
- Tombol **"📥 Export Excel"** (warna hijau)
- Download file: `Laporan-Keuangan-DD-MM-YY-HHMM.xlsx`
- Columns: Tanggal, Anggota, Jenis, Kategori, Nominal, Status, Keterangan
- Header styling: Background hijau, text putih
- Support filters: Jenis (pemasukan/pengeluaran), Tanggal range

---

### 3. **Manajemen Absensi** (`/dashboard/absensi`)

**Features:**
```
┌──────────────────────────────────────────┐
│ Absensi Kegiatan: [Nama Kegiatan]        │
│ [Search: nama/NIS] [Status ▼]            │
│ [📥 Export Excel] ← NEW! ✨              │
├──────────────────────────────────────────┤
│ Nama   | NIS | Status   | Catatan | Aksi│
├──────────────────────────────────────────┤
│ Budi   | 001 | Hadir    | -       | ✏️  │
│ Ani    | 002 | Izin     | Sakit   | ✏️  │
│ Citra  | 003 | Tidak    | -       | ✏️  │
└──────────────────────────────────────────┘
```

**Export Excel Features (NEW):**
- Tombol **"📥 Export Excel"** (warna biru)
- Download file: `Laporan-Absensi-DD-MM-YY-HHMM.xlsx`
- Columns: Kegiatan, Anggota, Status, Catatan, Tanggal Dibuat
- Header styling: Background biru, text putih
- Filter: Per kegiatan

---

### 4. **Manajemen Kegiatan** (`/dashboard/kegiatan`)

```
┌───────────────────────────────────────────┐
│ Manajemen Kegiatan                        │
│ [Search] [+ Tambah Kegiatan]              │
├───────────────────────────────────────────┤
│ Judul      | Tanggal | Lokasi | Status    │
├───────────────────────────────────────────┤
│ Latihan    | 20-10   | GOR A  | Aktif ✏️  │
│ Turnamen   | 25-10   | GOR B  | Draft ✏️  │
└───────────────────────────────────────────┘
```

---

### 5. **Manajemen Pengumuman** (`/dashboard/pengumuman`)

```
┌────────────────────────────────────────────────┐
│ Manajemen Pengumuman                           │
│ [+ Buat Pengumuman]                            │
├────────────────────────────────────────────────┤
│ Judul              | Tanggal | Status | Aksi  │
├────────────────────────────────────────────────┤
│ Jadwal Latihan ... | 15-10   | Draft  | ✏️ 🗑️ │
│ Info Turnamen ...  | 14-10   | Publish| ✏️ 🗑️ │
└────────────────────────────────────────────────┘
```

---

## ✨ EXPORT FEATURES (Phase 3)

### 📊 Export Keuangan

**Endpoint:** `GET /dashboard/keuangan/export?jenis=pemasukan&start_date=2026-10-01&end_date=2026-10-31`

**File Output:**
```
Laporan-Keuangan-16-10-26-154500.xlsx
```

**Excel Content:**

| Tanggal | Anggota | Jenis | Kategori | Nominal | Status | Keterangan |
|---------|---------|-------|----------|---------|--------|------------|
| 15-10-2026 | Budi | Pemasukan | Iuran | Rp 50.000 | Lunas | - |
| 14-10-2026 | Ani | Pemasukan | Iuran | Rp 50.000 | Pending | Cicilan |

**Features:**
- ✅ Styled header (green background)
- ✅ Support filter jenis
- ✅ Support filter date range
- ✅ Formatted currency (Rp)
- ✅ Permission check: Admin + Pembina only

---

### ✅ Export Absensi

**Endpoint:** `GET /dashboard/absensi/export?kegiatan_id=5`

**File Output:**
```
Laporan-Absensi-16-10-26-154500.xlsx
```

**Excel Content:**

| Kegiatan | Anggota | Status Kehadiran | Catatan | Tanggal Dibuat |
|----------|---------|------------------|---------|----------------|
| Latihan 15 Okt | Budi | Hadir | - | 15-10-2026 14:30 |
| Latihan 15 Okt | Ani | Izin | Sakit | 15-10-2026 14:30 |

**Features:**
- ✅ Styled header (blue background)
- ✅ Support filter per kegiatan
- ✅ Datetime formatting
- ✅ Permission check: Admin + Pembina only

---

## 🔐 ROLE & PERMISSIONS MATRIX

| Feature | Super Admin | Admin | Pembina | Member |
|---------|:-----------:|:-----:|:-------:|:------:|
| **Anggota** | | | | |
| View Anggota | ✅ | ✅ | ✅ | ❌ |
| Create/Edit/Delete | ✅ | ✅ | ❌ | ❌ |
| **Kegiatan** | | | | |
| View Kegiatan | ✅ | ✅ | ✅ | ✅ |
| Create/Edit/Delete | ✅ | ✅ | ❌ | ❌ |
| **Pendaftaran** | | | | |
| View Pendaftaran | ✅ | ✅ | ✅ | ✅ |
| Create/Edit/Delete | ✅ | ✅ | ❌ | ✅ |
| **Absensi** | | | | |
| View Absensi | ✅ | ✅ | ✅ | ✅ |
| Manage Absensi | ✅ | ✅ | ❌ | ❌ |
| **Export Absensi** | ✅ | ✅ | ✅ | ❌ |
| **Keuangan** | | | | |
| View Keuangan | ✅ | ✅ | ✅ | ❌ |
| Manage Keuangan | ✅ | ✅ | ❌ | ❌ |
| **Export Keuangan** | ✅ | ✅ | ✅ | ❌ |
| **Pengumuman** | | | | |
| View Pengumuman | ✅ | ✅ | ✅ | ✅ |
| Create/Edit/Delete | ✅ | ✅ | ❌ | ❌ |
| **Laporan** | | | | |
| View Laporan | ✅ | ✅ | ✅ | ❌ |
| **Admin Tools** | | | | |
| Manage Roles/Permissions | ✅ | ❌ | ❌ | ❌ |

---

## 📱 COMPLETE ROUTE STRUCTURE

### Public Routes (No Auth)
```
GET  /                           → Home/Landing page
GET  /kegiatan-publik           → Daftar kegiatan publik
GET  /kegiatan/{id}             → Detail kegiatan
GET  /pengumuman-publik         → Daftar pengumuman publik
GET  /login                     → Login form
```

### Protected Routes (Require Auth)
```
GET  /dashboard                 → Dashboard (role-specific)

ANGGOTA (Admin only):
GET  /dashboard/anggota         → Daftar anggota
GET  /dashboard/anggota/create  → Form tambah
POST /dashboard/anggota         → Save new
GET  /dashboard/anggota/{id}/edit → Form edit
PUT  /dashboard/anggota/{id}    → Update
DELETE /dashboard/anggota/{id}  → Delete

KEGIATAN (Admin + Member view):
GET  /dashboard/kegiatan        → Daftar kegiatan
GET  /dashboard/kegiatan/create → Form tambah
POST /dashboard/kegiatan        → Save new
GET  /dashboard/kegiatan/{id}/edit → Form edit
PUT  /dashboard/kegiatan/{id}   → Update
DELETE /dashboard/kegiatan/{id} → Delete

PENDAFTARAN (All auth users):
GET  /dashboard/pendaftaran-kegiatan  → Daftar pendaftar
GET  /dashboard/daftar-kegiatan      → Member: Kegiatan tersedia
POST /dashboard/daftar-kegiatan      → Member: Daftar kegiatan

ABSENSI (Admin + Pembina):
GET  /dashboard/absensi         → Daftar absensi
GET  /dashboard/absensi/export  → Export Excel ✨
POST /dashboard/absensi         → Save/Update

KEUANGAN (Admin + Pembina):
GET  /dashboard/keuangan        → Daftar transaksi
GET  /dashboard/keuangan/create → Form tambah
POST /dashboard/keuangan        → Save new
GET  /dashboard/keuangan/{id}/edit → Form edit
PUT  /dashboard/keuangan/{id}   → Update
DELETE /dashboard/keuangan/{id} → Delete
GET  /dashboard/keuangan/export → Export Excel ✨

PENGUMUMAN (Admin only):
GET  /dashboard/pengumuman      → Daftar pengumuman
GET  /dashboard/pengumuman/create → Form tambah
POST /dashboard/pengumuman      → Save new
GET  /dashboard/pengumuman/{id}/edit → Form edit
PUT  /dashboard/pengumuman/{id} → Update
DELETE /dashboard/pengumuman/{id} → Delete

LAPORAN (Admin + Pembina):
GET  /dashboard/laporan-keuangan → Laporan keuangan
GET  /dashboard/recap-absensi   → Rekap absensi

MEMBER ONLY:
GET  /dashboard/riwayat-absensi → Riwayat kehadiran
GET  /dashboard/riwayat-pembayaran → Riwayat pembayaran

SUPER ADMIN ONLY:
GET  /dashboard/role-permission → Manage roles & permissions
```

---

## 👤 LOGIN CREDENTIALS (Testing)

```
┌────────────────────────────────────────┐
│ SUPER ADMIN                            │
├────────────────────────────────────────┤
│ Email: nabilyusr4@gmail.com            │
│ Password: password123                  │
│ Role: Super Admin (Full Access)        │
└────────────────────────────────────────┘

┌────────────────────────────────────────┐
│ ADMIN (Test)                           │
├────────────────────────────────────────┤
│ Email: admin@sibasket.test             │
│ Password: password                     │
│ Role: Admin (CRUD All Modules)         │
└────────────────────────────────────────┘

┌────────────────────────────────────────┐
│ PEMBINA (Test)                         │
├────────────────────────────────────────┤
│ Email: pembina@sibasket.test           │
│ Password: password                     │
│ Role: Pembina (View-Only + Export)     │
└────────────────────────────────────────┘

┌────────────────────────────────────────┐
│ MEMBER (Test)                          │
├────────────────────────────────────────┤
│ Email: member@sibasket.test            │
│ Password: password                     │
│ Role: Member (Limited Access)          │
└────────────────────────────────────────┘
```

---

## 🎨 UI/UX DESIGN NOTES

### Color Scheme
- **Primary:** Blue (#0066CC)
- **Success:** Green (#22C55E)
- **Warning:** Orange (#F59E0B)
- **Danger:** Red (#EF4444)
- **Background:** Light Gray (#F3F4F6)

### Typography
- **Headers:** Bold, size 24-32px
- **Subheaders:** Semibold, size 16-20px
- **Body:** Regular, size 14-16px

### Components
- Tables: Responsive, striped rows, hover effects
- Forms: Clean layout, clear labels, validation messages
- Buttons: Rounded corners, hover animations, clear labels
- Cards: White background, subtle shadows, spacing

### Responsive Design
- Mobile: Stack layout, hamburger menu
- Tablet: 2-column layout
- Desktop: Full sidebar + content layout

---

## 📋 FEATURE CHECKLIST

### Phase 1-5 ✅ Complete
- [x] Anggota CRUD
- [x] Kegiatan CRUD
- [x] Pendaftaran & Absensi
- [x] Keuangan (TransaksiKas)
- [x] Pengumuman CRUD
- [x] Dashboard Analytics
- [x] Role-Based Access Control
- [x] Public Pages

### Phase 3 ✅ Complete (NEW!)
- [x] Export Keuangan to Excel
- [x] Export Absensi to Excel
- [x] Permission checks on export
- [x] UI buttons on tables

### Phase 4 (Remaining)
- [ ] Smoke test manual (browser)
- [ ] Production deployment
- [ ] Database backup strategy

---

## 📞 Support & Contact

Untuk pertanyaan mengenai struktur website atau fitur, silakan merujuk ke dokumentasi lainnya:
- `docs/02-role-dan-akses.md` — Detail permissions
- `docs/04-business-flow-dan-rules.md` — Business logic
- `docs/09-roadmap-6-minggu.md` — Timeline

---

**Generated:** Oct 16, 2026
**Status:** SiBasket v1.0 (MVP Ready)
