# 05. Application Architecture & Technology Stack

[← Kembali ke index](./00-README.md)

> **Status:** ✅ Updated — Full Livewire (pivot dari Filament)
> **Last updated:** 07 Oktober 2026
> **Lihat:** [`13-full-livewire-decision.md`](./13-full-livewire-decision.md) untuk latar belakang keputusan

---

## 5.1 Architecture — Full Livewire Integration

```text
                         SIBASKET
                              │
              ┌───────────────┴───────────────┐
              │                               │
         PUBLIC PAGES                   ADMIN/MEMBER DASHBOARD
         (Guest, No Auth)         (All Users — Role-Based Access)
              │                               │
          Blade + CSS                  Livewire Components
              │                               │
              └───────────────┬───────────────┘
                              │
                           Laravel 11+
                              │
                    ┌─────────┴─────────┐
                    │                   │
                 Eloquent             MySQL
              (Models)            (with Triggers
                                   & Functions)
```

### Public Pages
**Teknologi:** Blade, Tailwind CSS (no auth required)
**Digunakan untuk:**
- Homepage (profil organisasi)
- Jadwal Kegiatan (list public)
- Pengumuman (published only)
- Gallery (optional)

### Admin Dashboard
**Teknologi:** Livewire 3, Blade, Tailwind CSS (auth required, role-based)
**Digunakan untuk:**
- CRUD Anggota, Kegiatan, Pendaftaran, Absensi
- Manajemen Keuangan (TransaksiKas)
- Manajemen Pengumuman
- Dashboard dengan statistik & charts
- Audit logs (activity tracking)

### Member Dashboard
**Teknologi:** Livewire 3, Blade, Tailwind CSS (auth required, view-only)
**Digunakan untuk:**
- View-only: Absensi pribadi
- View-only: Pembayaran kas pribadi
- View-only: Kegiatan yang terdaftar

### Authentication
**Teknologi:** Laravel Breeze + Spatie Laravel-Permission
**Alur:**
- Satu halaman login (`/auth/login`) untuk semua role
- System cek role → redirect ke dashboard yang sesuai
- Sidebar menu dinamis per role

---

## 5.2 Technology Stack — Full Livewire

| Bagian | Teknologi |
|---|---|
| **Backend** | Laravel 11/12 (LTS/stable) |
| **Language** | PHP 8.2+ |
| **Database** | MySQL 8.0+ |
| **Frontend UI** | Blade + Livewire 3 |
| **CSS** | Tailwind CSS v3 |
| **Role & Permission** | Spatie Laravel-Permission |
| **Authentication** | Laravel Breeze + Custom Gates/Policies |
| **Database Features** | Triggers, Functions, Views (for reporting) |
| **Export** | Maatwebsite/Excel (Laravel Excel) |
| **Components** | Reusable Blade + Livewire components |
| **Charts** | Chart.js (optional, for dashboard widgets) |
| **Version Control** | Git + GitHub |
| **Deployment** | [Hosting pilihan: Railway/Niagahoster/shared hosting] |

---

## 5.3 Why Full Livewire (Not Filament)?

**Keputusan pivot tanggal 07 Oktober 2026 — lihat [`13-full-livewire-decision.md`](./13-full-livewire-decision.md) untuk detail**

### ✅ Alasan Pilih Full Livewire

1. **Admin Interface Custom** → tidak terasa "template standar"
2. **Learning Outcome Tinggi** → paham Livewire lifecycle, database design, transactions
3. **Portfolio Standout** → bukan Filament scaffold yang umum di pasaran
4. **Integrated Login Flow** → satu halaman login untuk semua role (lebih professional)
5. **Member Dashboard** → aplikasi integrated, bukan hanya admin panel terpisah
6. **Scalable & Flexible** → mudah extend untuk phase 2 (fitur baru, mobile app, API)

### ⚠️ Trade-offs

- **Timeline:** 6 minggu vs 3-4 minggu (Filament)
- **Effort:** ~220 jam (Full Livewire) vs ~100 jam (Filament)
- **Learning curve:** Livewire lifecycle & reactivity (Ada time investment untuk learn)

---

## 5.4 Key Technical Decisions

### Database Layer (Independent dari UI)

- **Triggers:** Automatic update saldo kas saat transaksi
- **Functions:** Calculate absensi %, monthly balance, payment status
- **Transactions:** DB::transaction() untuk rollback/commit logic
- **Audit Trail:** Log setiap perubahan (create/update/delete)

### Frontend Components

- **Livewire Table Components:**
  - AnggotaTable, KegiatanTable, AbsensiTable, TransaksiKasTable, PengumumanTable
  - Features: search (live), filter, pagination, sort
  - Authorization: via Gate/Policy

- **Livewire Form Components:**
  - AnggotaForm, KegiatanForm, AbsensiForm, TransaksiKasForm, PengumumanForm
  - Features: validation (real-time), error display, file upload
  - Transaction wrapper untuk consistency

- **Reusable Blade Components:**
  - button, modal, alert, pagination, table-header
  - Consistent styling via Tailwind CSS

### Role-Based Access

**Sidebar menu dinamis:**
- Super Admin → semua menu
- Admin → semua menu (kecuali user management)
- Bendahara → Keuangan, Absensi (read), Pengumuman
- Sie Absensi → Absensi, Anggota (read), Kegiatan (read)
- Member → Member Dashboard (view-only, data pribadi)

---

## 5.5 Deployment Architecture

```
Development                  Staging                    Production
(Local Machine)         (Test Server)                 (Live Server)
      │                      │                              │
   .env.local            .env.staging               .env.production
   SQLite/MySQL          MySQL                      MySQL
   APP_DEBUG=true        APP_DEBUG=false            APP_DEBUG=false
      │                      │                              │
   (git push)          (merge pull request)      (automated deploy)
      │                      │                              │
   Code Review         QA Testing              Live Monitoring
   Feature Branch      All Roles Test          Backup Strategy
                      Load Testing
```

---

## 5.6 Version Management

> **Catatan penting:** Pilih versi yang **stabil dan sudah rilis resmi** saat mulai coding.
> Cek dokumentasi resmi di momen itu, jangan asumsikan dari dokumen ini yang dibuat awal planning.

### Rekomendasi Versi (per 07 Oktober 2026)

- Laravel 11 LTS (or 12 jika sudah stable)
- PHP 8.2 or 8.3
- Livewire 3.x
- Tailwind CSS 3.x
- Spatie Laravel-Permission 6.x
- Laravel Breeze (latest)

### Compatibility Check

Sebelum mulai:
```bash
composer require laravel/framework:^11.0 livewire/livewire:^3.0
npm install tailwindcss
php -v  # Verify PHP version
```

---

> **Next:** Lihat [`14-full-livewire-skenario.md`](./14-full-livewire-skenario.md) untuk file structure & implementation patterns
> **Timeline:** [`09-roadmap-6-minggu.md`](./09-roadmap-6-minggu.md)
