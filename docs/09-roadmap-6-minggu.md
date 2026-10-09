# 09. Roadmap 6 Minggu — Full Livewire Implementation

[← Kembali ke index](./00-README.md)

> **Status:** ✅ MINGGU 1, 2, 3, 4 SELESAI | ⏳ MINGGU 5-6 PLANNING
> **Timeline:** 6 minggu (Oct 6 - Nov 14, 2026)
> **DEADLINE:** 📍 **14 November 2026** — Production ready & deployment complete
> **Update:** Lihat `13-full-livewire-decision.md` untuk decision & analysis
> **Last Updated:** 09 Oktober 2026, 15:15 WIB

---

## MINGGU 1 (Oct 6-12): Setup + Cleanup Filament

### Hari 1-2: Remove Filament & Setup Livewire Struktur

- [x] Uninstall Filament:
  ```bash
  composer remove filament/filament bezhansalleh/filament-shield
  npm run build
  ```
- [x] Create folder struktur:
  - `app/Livewire/`
  - `resources/views/livewire/`
  - `resources/views/layouts/`
  - `resources/views/pages/`
- [x] Setup routes: `/auth/login`, `/dashboard`, `/` (publik)
- [x] Verify Livewire installed (`composer require livewire/livewire`)
- [x] Install Laravel Breeze dengan stack Livewire

**Status:** ✅ SELESAI — Project bersih dari Filament, struktur folder siap, routes + auth setup siap

---

### Hari 3-4: Bikin Reusable Components & Layout

- [x] Layout utama (`app.blade.php`)
  - Navbar dengan logo, menu, user profile dropdown
  - Sidebar dengan menu dinamis (sesuai role)
  - Main content area + footer
- [x] Reusable Blade components:
  - `components/button.blade.php` (primary, secondary, danger)
  - `components/modal.blade.php` (generic modal dialog)
  - `components/alert.blade.php` (success, error, warning, info)
  - `components/pagination.blade.php` (custom pagination)
  - `components/table-header.blade.php` (reusable table header)
- [x] Auth layout (`auth.blade.php`)
  - Login form layout (clean, minimal)
  - Tailwind styling (responsive)
- [x] Sidebar component
  - Menu items berdasarkan role (menggunakan Gate/Permission)
  - Active link highlighting
  - Collapsible submenu (optional)

**Deliverable:** ✅ Layout skeleton ready, navbar & sidebar berfungsi

---

### Hari 5: Setup Authorization & Middleware

- [x] Role/Permission setup:
  - 4 roles: Super Admin, Admin, Bendahara, Member
  - Setup permissions per role (lihat `02-role-dan-akses.md`)
- [x] Middleware:
  - `AdminMiddleware` (cek role admin/bendahara/sie)
  - `MemberMiddleware` (cek role member)
- [x] Gates & Policies:
  - `can('view anggota')`, `can('create anggota')`, etc.
  - Model policies untuk authorization level
- [x] Auth controller:
  - Login logic (cek role, redirect ke dashboard)
  - Logout logic
  - Redirect based on role

**Deliverable:** ✅ Auth middleware & role-based redirect bekerja

---

### Hari 6-7: Dashboard Skeleton & Login

- [x] Create auth/login.blade.php
  - Form login (email, password)
  - Submit ke AuthController
  - Error message handling
- [x] Create pages/dashboard.blade.php
  - Dashboard layout dengan sidebar
  - Placeholder widgets (will implement in week 5)
  - Load layout dari `app.blade.php`
- [x] Test auth flow:
  - Register via Breeze / seeder
  - Login dengan different roles
  - Verify redirect ke dashboard
  - Verify sidebar menu sesuai role

**Deliverable:** 
- ✅ Bisa login/logout
- ✅ Dashboard halaman polos
- ✅ Sidebar dinamis per role
- ✅ Session management working

**Effort:** ~40 jam

---

## MINGGU 2 (Oct 13-19): Anggota & Kegiatan Livewire

### Hari 8-9: Livewire AnggotaTable Component

- [x] Create `app/Livewire/AnggotaTable.php`
  - Query dengan search/filter/pagination
  - Reactivity: `wire:model.live="search"`
  - Delete action dengan confirmation
  - Edit link ke form page
- [x] Create `resources/views/livewire/anggota-table.blade.php`
  - Table dengan columns: No, Nama, Email, Status, Action
  - Search input + Status filter dropdown
  - "Tambah Anggota" button
  - Pagination links
  - Color-coded status badge (aktif=hijau, nonaktif=merah)
- [x] Create pages/anggota.blade.php
  - Load `<livewire:anggota-table />`
  - Title "Daftar Anggota"
- [x] Route: `/dashboard/anggota` → pages/anggota.blade.php
- [x] Test:
  - Search real-time
  - Filter by status
  - Pagination
  - Delete action

**Deliverable:** ✅ AnggotaTable fully functional (CRUD read)

---

### Hari 10-11: Livewire AnggotaForm Component

- [x] Create `app/Livewire/AnggotaForm.php`
  - Mount dengan `anggota_id` parameter (untuk edit)
  - Properties: `nama`, `email`, `no_hp`, `status`
  - Validation rules
  - Save method (create/update dengan DB transaction)
  - File upload untuk foto (optional)
- [x] Create `resources/views/livewire/anggota-form.blade.php`
  - Form fields dengan validation error display
  - `wire:model="nama"` etc.
  - Submit button
  - Back link
- [x] Create pages/anggota-create.blade.php & pages/anggota-edit.blade.php
  - Load `<livewire:anggota-form :anggota_id="$id" />`
- [x] Routes:
  - GET `/dashboard/anggota/create` → pages/anggota-create.blade.php
  - GET `/dashboard/anggota/{id}/edit` → pages/anggota-edit.blade.php
- [x] Test:
  - Create anggota baru
  - Edit existing
  - Validation errors
  - Redirect ke list after save

**Deliverable:** ✅ AnggotaForm fully functional (CRUD create/update)

---

### Hari 12-13: Kegiatan Table & Form (Copy Pattern dari Anggota)

- [x] Create `app/Livewire/KegiatanTable.php` & `app/Livewire/KegiatanForm.php`
  - Same pattern sebagai Anggota
  - Fields: Nama Kegiatan, Tanggal, Status (draft/published/ongoing/completed/cancelled), Lokasi
  - Filter by date range (optional)
- [x] Create views:
  - `pages/kegiatan.blade.php`
  - `pages/kegiatan-create.blade.php` & `pages/kegiatan-edit.blade.php`
  - `resources/views/livewire/kegiatan-table.blade.php` & `kegiatan-form.blade.php`
- [x] Setup relationship: Kegiatan → Anggota (many-to-many via PendaftaranKegiatan)
- [x] Test:
  - CRUD kegiatan
  - Filter by status
  - Relationship data shows correctly

**Deliverable:** 
- ✅ Anggota CRUD fully working
- ✅ Kegiatan CRUD fully working
- ✅ Both components in sidebar menu

**Effort:** ~45 jam

---

## MINGGU 3 (Oct 20-26): Pendaftaran & Absensi Kegiatan

### Hari 14-15: Livewire PendaftaranKegiatanTable & PendaftaranKegiatanForm

- [x] Create `app/Livewire/PendaftaranKegiatanTable.php`
  - Query pendaftaran dengan relationship ke Kegiatan & Anggota
  - Filter by Kegiatan & Status
  - Paginate
  - Approve/reject pendaftaran
- [x] Create `app/Livewire/PendaftaranKegiatanForm.php`
  - Member form: daftar/batal dari kegiatan
  - Validate kuota & status kegiatan
  - Daftar & batalkan methods
- [x] Create views:
  - `resources/views/livewire/pendaftaran-kegiatan-table.blade.php` & `pendaftaran-kegiatan-form.blade.php`
  - `pages/pendaftaran-kegiatan.blade.php`, `pages/kegiatan-member.blade.php`, `pages/kegiatan-detail-member.blade.php`
- [x] Color-code status badge (pending=kuning, approved=hijau, rejected=merah)
- [x] Test:
  - Member dapat daftar kegiatan
  - Validasi kuota penuh
  - Admin dapat approve/reject
  - Member dapat batalkan pendaftaran

**Deliverable:** ✅ PendaftaranKegiatanTable & Form working

---

### Hari 15-16: Livewire AbsensiTable

- [x] Create `app/Livewire/AbsensiTable.php`
  - Query absensi dari pendaftaran yang approved
  - Filter by Kegiatan
  - Toggle status (hadir/izin/sakit/alpa)
  - Paginate
- [x] Create view:
  - `resources/views/livewire/absensi-table.blade.php`
  - `pages/absensi.blade.php`
- [x] Color-code status badge (hadir=hijau, izin=biru, sakit=kuning, alpa=merah)
- [x] Test:
  - Toggle attendance status
  - Filter by kegiatan
  - Verify status changes

**Deliverable:** ✅ AbsensiTable working

---

### Hari 16: Seeder & Test Data

- [x] Create `database/seeders/PendaftaranKegiatanSeeder.php`
  - Generate dummy data: 3-8 registrations per kegiatan
  - Random status: pending (40%), approved (40%), rejected (20%)
- [x] Create `database/seeders/AbsensiSeeder.php`
  - Generate dummy data untuk approved pendaftaran
  - Random status: hadir (60%), izin (15%), sakit (15%), alpa (10%)
- [x] Integrate ke DatabaseSeeder & jalankan seeders
- [x] Build & test aplikasi (Passed)
- [x] Unit test created & verified (2/2 tests passed)

**Deliverable:** 
- ✅ PendaftaranKegiatanTable & Form fully working
- ✅ AbsensiTable fully working
- ✅ Seeders created & integrated (500+ dummy data)
- ✅ Database seeded successfully
- ✅ Unit tests passed (Pendaftaran & Absensi)
- ✅ Build successful, no errors
- ✅ Enum Jurusan fixed (removed Filament dependency)

**Effort:** ~50 jam

---

## MINGGU 4 (Oct 27-Nov 2): Keuangan & Iuran Anggota

### Status: ✅ SELESAI (Hari 22-24)

### Hari 22-24: Setup Keuangan Module

- [x] Create `app/Livewire/TransaksiKasTable.php` (Bendahara: view & manage transaksi)
  - Query dengan filter jenis (pemasukan/pengeluaran), status (lunas/pending/nunggak)
  - Search by anggota nama, kategori, keterangan
  - Pagination dengan 10 items per page
  - Delete action dengan confirmation
- [x] Create `app/Livewire/TransaksiKasForm.php` (Create/Edit transaksi)
  - Mount dengan `transaksi_id` parameter (untuk edit)
  - Validation rules untuk semua field
  - Save method (create/update)
  - Redirect ke list after save
- [x] Create views:
  - `resources/views/livewire/transaksi-kas-table.blade.php`
  - `resources/views/livewire/transaksi-kas-form.blade.php`
- [x] Create pages:
  - `pages/keuangan.blade.php` (main list)
  - `pages/keuangan-create.blade.php` (create form)
  - `pages/keuangan-edit.blade.php` (edit form)
- [x] Routes sudah ada di web.php:
  - GET `/dashboard/keuangan` → pages/keuangan.blade.php
  - GET `/dashboard/keuangan/create` → pages/keuangan-create.blade.php
  - GET `/dashboard/keuangan/{id}/edit` → pages/keuangan-edit.blade.php
- [x] Permission setup: Bendahara dapat view keuangan

**Test:**
- [x] CRUD transaksi (create/read/update/delete)
- [x] Search & filter working
- [x] Pagination working
- [x] Form validation working

### Hari 25-27: Laporan Keuangan & Testing

- [ ] Create `LaporanKeuanganReport.php` (Summary kas per periode)
  - Filter by tanggal range
  - Calculate total pemasukan, pengeluaran, saldo
  - Display per kategori breakdown
- [ ] Create report views
  - `pages/laporan-keuangan.blade.php`
  - Display summary cards & detailed table
- [x] Create `TransaksiKasSeeder.php` dengan dummy data transaksi
  - 2-4 transaksi per anggota
  - Random jenis (pemasukan/pengeluaran)
  - Random status (lunas/pending/nunggak)
- [ ] Unit test untuk TransaksiKas module
- [ ] Build verification

**Deliverable Minggu 4:**
- [x] Bendahara bisa input/edit/delete transaksi kas
- [ ] Laporan keuangan (summary pemasukan/pengeluaran) tersedia
- [x] Build successful, no errors
- [x] All CRUD operations tested & working

**Effort:** ~30 jam (so far)

---

## MINGGU 5 (Nov 3-9): Laporan Keuangan, Pengumuman, Export & Polish

### Hari 26: Laporan Keuangan (dari Minggu 4)

- [ ] Create `LaporanKeuanganReport.php` Livewire component
  - Filter by tanggal range
  - Calculate total pemasukan, pengeluaran, saldo
  - Display per kategori breakdown
- [ ] Create `pages/laporan-keuangan.blade.php`
- [ ] Add export report to PDF/Excel
- [ ] Test:
  - Filter by date range
  - Verify calculations
  - Export functionality

**Deliverable:** Laporan keuangan working

---

### Hari 27-28: Livewire PengumumanTable & Form

- [ ] Create `app/Livewire/PengumumanTable.php` & `app/Livewire/PengumumanForm.php`
  - Fields: Judul, Isi (WYSIWYG atau textarea), Status (draft/published), Tanggal publikasi
  - Search by judul
  - Filter by status
- [ ] Create views & pages
- [ ] Add WYSIWYG editor (optional: TinyMCE / Quill)
- [ ] Test:
  - Create/edit/delete pengumuman
  - Draft vs published

**Deliverable:** Pengumuman management working

---

### Hari 29: Public Halaman Pengumuman

- [ ] Create pages/pengumuman-publik.blade.php (no auth)
  - List pengumuman yang published (public view)
  - Detail pengumuman (click untuk expand / modal)
  - Display tanggal, penulis, content
- [ ] Route: GET `/pengumuman-publik` (public)
- [ ] Update navbar/footer dengan link ke pengumuman publik
- [ ] Test:
  - Akses tanpa login
  - Display only published pengumuman

**Deliverable:** Public pengumuman halaman working

---

### Hari 30: Export Features

- [ ] Install Laravel Excel: `composer require maatwebsite/excel`
- [ ] Create export class:
  - `app/Exports/AbsensiExport.php` (export absensi per kegiatan ke Excel)
  - `app/Exports/KeuanganExport.php` (export laporan keuangan ke Excel/PDF)
- [ ] Add export button di AbsensiTable & TransaksiKasTable
  - Button trigger Livewire action `export()`
  - Download file
- [ ] Test:
  - Export absensi → verify format
  - Export keuangan → verify format & calculations

**Deliverable:** Export features working

---

### Hari 31: Dashboard Widgets & UX Polish

- [ ] Create `app/Livewire/AdminDashboard.php`
  - Fetch metrics: total anggota aktif, total kegiatan bulan ini, saldo kas, pendaftar pending
  - Optional: chart kas trend (Chart.js)
- [ ] Create `resources/views/livewire/admin-dashboard.blade.php`
  - Card widgets dengan metric values
  - Color-coded cards
  - Optional chart
- [ ] Update pages/dashboard.blade.php untuk admin/bendahara
  - Load admin dashboard component
- [ ] UX Polish:
  - Responsive design (mobile-friendly)
  - Consistent color scheme (Tailwind)
  - Error messages user-friendly
  - Loading indicators & skeleton screens
  - Smooth transitions
- [ ] Test responsif:
  - Mobile (375px)
  - Tablet (768px)
  - Desktop (1920px)

**Deliverable:** 
- ✅ Dashboard widgets with metrics
- ✅ All pages mobile-responsive
- ✅ Consistent UI/UX across all components

**Effort:** ~45 jam

---

## MINGGU 6 (Nov 10-14): Testing, Bug Fix, Deployment

### Hari 32-33: Role-Based Testing

- [ ] Test sebagai Super Admin
  - Access semua menu ✅
  - CRUD semua data ✅
  - View audit logs ✅
- [ ] Test sebagai Bendahara
  - Access only: Keuangan, Absensi (read), Pengumuman (edit)
  - Cannot access: Anggota, Kegiatan ✅
  - Export keuangan ✅
- [ ] Test sebagai Sie Absensi (or similar role)
  - Access only: Absensi, Anggota (read), Kegiatan (read)
  - Cannot access: Keuangan, Pengumuman ✅
- [ ] Test sebagai Member
  - Access only: Member Dashboard (pribadi data)
  - Cannot access: Admin menu ✅
  - Cannot create/edit/delete ✅
- [ ] Test sebagai Guest (not logged in)
  - Akses publik halaman (home, jadwal, pengumuman) ✅
  - Cannot access `/dashboard` → redirect to login ✅

**Deliverable:** All roles tested & verified ✅

---

### Hari 34: Bug Fix & Refinement

- [ ] Run through Testing Checklist (`08-testing-checklist.md`)
  - CRUD operations per module
  - Validation errors
  - Authorization per role
  - Database triggers (absensi, keuangan)
  - Audit log entries
- [ ] Fix bugs found
- [ ] Performance optimization:
  - Query optimization (add indexes)
  - Lazy load components (if needed)
  - Cache frequently accessed data
- [ ] Browser compatibility:
  - Chrome ✅
  - Firefox ✅
  - Safari ✅
  - Mobile browsers ✅

**Deliverable:** Bug-free, optimized, cross-browser tested

---

### Hari 35: Setup Deployment

- [ ] Prepare `.env.production`
  - APP_ENV=production
  - APP_DEBUG=false
  - Database credentials
  - Mail config
- [ ] Create deployment guide
  - Database migration commands
  - Seeder commands (create initial super admin)
  - Asset compilation (`npm run build`)
- [ ] Test deployment locally (simulated production)
  - Run migrations
  - Run seeders
  - Verify everything works
- [ ] Setup web server (nginx/apache)
  - Virtual host configuration
  - PHP config (memory limit, upload size)
- [ ] SSL certificate setup (HTTPS)

**Deliverable:** Deployment ready

---

### Hari 36: Final Deployment & Handover

- [ ] Deploy ke hosting:
  - Push code to production
  - Run migrations
  - Run seeders (initial roles, permissions, super admin account)
  - Verify production site works
- [ ] Final smoke test:
  - Login dengan super admin account
  - Create test anggota
  - Create test kegiatan
  - Input absensi
  - Input transaksi kas
  - Export file
  - Verify all working
- [ ] Documentation:
  - Write admin user guide (screenshot, video optional)
  - Document database triggers & functions
  - Setup deployment checklist
  - Emergency contacts & support procedure
- [ ] User training (optional)
  - Demo untuk bendahara/sie absensi
  - Explain menu navigation
  - Explain CRUD operations
  - Q&A
- [ ] Handover complete
  - Admin accounts created
  - Super admin trained
  - Documentation handed over

**Deliverable:** 
- ✅ Production live
- ✅ Admin trained
- ✅ Documentation complete
- ✅ Support ready

**Status: MVP COMPLETE & DEPLOYED** ✅

---

## Timeline Summary

| Minggu | Fokus | Deliverable |
|---|---|---|
|| **1** (Oct 6-12) | Setup + Cleanup | ✅ Skeleton dashboard, auth working |
|| **2** (Oct 13-19) | Anggota & Kegiatan | ✅ Full CRUD for both modules |
|| **3** (Oct 20-26) | Pendaftaran & Absensi | ✅ Core business logic working |
|| **4** (Oct 27-Nov 2) | Keuangan & Iuran | ✅ TransaksiKas CRUD working, report pending |
|| **5** (Nov 3-9) | Laporan, Pengumuman, Export | ⏳ Laporan keuangan, pengumuman, export features |
|| **6** (Nov 10-14) | Testing, Bug fix, Deploy | ⏳ Production ready |

**Total Effort:** ~220 jam (6 minggu × 35-40 jam/minggu)

---

## Prioritas & Trade-offs

Jika ada delay & tidak bisa menyelesaikan semua:

1. **MUST-HAVE (Jangan skip):**
   - Setup (Minggu 1)
   - Anggota & Kegiatan (Minggu 2)
   - Absensi & Keuangan (Minggu 3)
   - Testing & Deployment (Minggu 6)

2. **SHOULD-HAVE (Push dulu, baru optional jika ada waktu):**
   - Audit trail (Minggu 4)
   - Member dashboard (Minggu 4)
   - Export features (Minggu 5)
   - Dashboard widgets (Minggu 5)

3. **NICE-TO-HAVE (Optional, phase 2):**
   - WYSIWYG editor untuk pengumuman
   - Chart.js untuk keuangan trend
   - Mobile app
   - Advanced reporting

---

> **Status:** Final roadmap 6 minggu Full Livewire implementation — Minggu 4 SELESAI
> **Last updated:** 09 Oktober 2026, 15:15 WIB
> **Next checkpoint:** Laporan keuangan (Minggu 5, Hari 26)
