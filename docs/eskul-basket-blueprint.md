# SIBASKET — Sistem Informasi Eskul Basket

> **Status:** Draft / Planning
> **Versi:** 0.1
> **Deadline:** 2 minggu dari tanggal mulai (isi tanggal pastinya di sini)
> **Developer:** [Nama kamu]
> **Organisasi:** Eskul Basket [Nama Sekolah]

---

# 1. Overview

## 1.1 Deskripsi

SIBASKET adalah aplikasi berbasis web untuk membantu pengurus Eskul Basket dalam mengelola keanggotaan, jadwal latihan/pertandingan, pendaftaran kegiatan, absensi, dan pengumuman, secara terpusat — menggantikan cara manual (grup WhatsApp, catatan kertas, Excel terpisah).

Aplikasi terdiri dari:

* **Public Website** — dapat diakses siapa saja (calon anggota, siswa, orang tua) tanpa login.
* **Management System (Admin Panel)** — digunakan oleh pengurus eskul dan pembina untuk mengelola data.
* **Member Area** — digunakan oleh anggota eskul yang sudah terdaftar.

## 1.2 Tujuan

1. Memusatkan data anggota, jadwal, dan kehadiran dalam satu sistem, menggantikan pencatatan manual/tersebar.
2. Mempermudah proses pendaftaran kegiatan (latihan, pertandingan, seleksi) secara online dengan validasi otomatis (kuota, status aktif, duplikasi).
3. Memberikan visibilitas kepada pembina atas kondisi eskul (jumlah anggota aktif, tingkat kehadiran, kegiatan berjalan) tanpa harus menghubungi pengurus satu per satu.
4. Menyediakan laporan mingguan yang bisa diserahkan ke pembina sebagai bukti progres pengerjaan sekaligus bukti manfaat aplikasi bagi organisasi.

---

# 2. Problem Statement

| No | Masalah | Kondisi Saat Ini | Solusi |
|----|---------|-------------------|--------|
| 1 | Data anggota tersebar (grup WA, catatan manual) | Pengurus sulit tahu siapa saja anggota aktif | Modul Manajemen Anggota terpusat |
| 2 | Absensi latihan dicatat manual di kertas/buku | Rawan hilang, sulit direkap untuk laporan | Modul Absensi digital per kegiatan |
| 3 | Pendaftaran kegiatan/seleksi lewat chat, rawan salah data & duplikat | Pengurus harus rekap manual dari chat | Modul Pendaftaran Kegiatan dengan validasi otomatis |
| 4 | Pengumuman eskul (jadwal, hasil seleksi) tersebar di berbagai grup | Info sering terlambat sampai/tidak konsisten | Modul Pengumuman terpusat di web publik |

> **Catatan:** Isi ulang tabel ini setelah kamu ngobrol singkat dengan ketua/pengurus eskul beneran — ini contoh masalah umum eskul olahraga, sesuaikan dengan kondisi asli di sekolahmu supaya laporan ke pembina lebih kuat (bukan asumsi kamu sendiri).

---

# 3. Role & Struktur Akses

Berdasarkan diskusi, struktur akses dibuat **4 role dasar**, dengan Admin memakai **permission granular per menu** (bukan role terpisah untuk tiap posisi pengurus). Ini dipilih supaya struktur pengurus asli (ketua, bendahara, sie absensi, dll) tetap terwakili tanpa menambah kompleksitas otorisasi yang tidak sepadan dengan waktu 2 minggu.

## 3.1 Super Admin
Kamu sebagai developer / penanggung jawab sistem.
* Full access ke seluruh modul.
* Mengelola akun pengurus (Admin) dan meng-assign permission ke masing-masing.
* Mengelola role & permission itu sendiri.

## 3.2 Admin (Pengurus Eskul)
Satu role "Admin", tapi tiap akun Admin diberi kombinasi **permission** sesuai jabatannya di eskul:

| Jabatan Asli | Permission yang di-assign |
|---|---|
| Ketua | `manage-anggota`, `manage-kegiatan`, `manage-absensi`, `manage-pengumuman`, `view-laporan` (hampir full) |
| Wakil Ketua | sama seperti Ketua, atau subset sesuai kebutuhan |
| Sekretaris | `manage-anggota`, `manage-pengumuman` |
| Bendahara | `manage-keuangan` *(masuk Optional/Future, lihat §5)* |
| Sie Absensi | `manage-absensi` |
| Sie Acara/Kegiatan | `manage-kegiatan` |

Permission dikelola lewat 1 sistem (`spatie/laravel-permission` + `filament-shield`), sehingga menambah/mengurangi akses jabatan baru tidak perlu ubah struktur sistem, cukup atur assignment.

## 3.3 Pembina
* Akses **view-only** ke seluruh data: anggota, kegiatan, absensi, laporan.
* Tidak bisa mengubah/menghapus data apa pun.
* Ini role yang akan dipakai pembina kamu untuk memantau progres aplikasi juga.

## 3.4 Member (Anggota Eskul)
* Login dengan akun sendiri.
* Melihat jadwal kegiatan, mendaftar kegiatan, melihat riwayat kehadiran & pendaftaran sendiri.
* Tidak bisa melihat data anggota lain.

## 3.5 Guest (Belum Login)
* Melihat halaman publik: info eskul, jadwal/kegiatan yang dipublish, pengumuman, galeri (jika sempat).

---

# 4. Scope

## 4.1 MVP — WAJIB selesai dalam 2 minggu

> Ini adalah kontrak scope kamu. Kalau pembina minta tambahan di luar ini, catat di §16 (Changelog) sebagai perubahan scope, jangan diam-diam dikerjakan — supaya deadline tetap bisa dipertanggungjawabkan.

### Public (Guest)
- [ ] Home (info singkat eskul)
- [ ] Tentang Eskul
- [ ] Daftar Kegiatan (jadwal latihan/pertandingan yang dipublish)
- [ ] Detail Kegiatan
- [ ] Pengumuman (list + detail)
- [ ] Login

### Admin (Super Admin + Admin)
- [ ] Login & Dashboard (ringkasan: jumlah anggota aktif, kegiatan berjalan, tingkat kehadiran terakhir)
- [ ] Manajemen Anggota (CRUD + status aktif/nonaktif)
- [ ] Manajemen Kegiatan (CRUD + status: draft/published/ongoing/completed/cancelled)
- [ ] Manajemen Pendaftaran (lihat siapa saja yang daftar per kegiatan, approve/reject jika perlu)
- [ ] Manajemen Absensi (input kehadiran per kegiatan: Hadir/Izin/Sakit/Alpa)
- [ ] Manajemen Pengumuman (CRUD)
- [ ] Manajemen Role & Permission (khusus Super Admin — assign permission ke Admin)
- [ ] Laporan sederhana (rekap kehadiran per anggota, per kegiatan)

### Pembina
- [ ] Login & Dashboard (view-only, sama seperti dashboard admin tapi read-only)
- [ ] Lihat Anggota, Kegiatan, Absensi, Laporan (tanpa tombol edit/hapus)

### Member
- [ ] Login
- [ ] Lihat & daftar kegiatan
- [ ] Lihat riwayat pendaftaran sendiri
- [ ] Lihat riwayat kehadiran sendiri
- [ ] Edit profil dasar

---

## 5. Optional Features (dikerjakan HANYA jika MVP selesai lebih cepat)

- [ ] Modul Keuangan sederhana (kas masuk/keluar, khusus bendahara)
- [ ] Galeri dokumentasi kegiatan (upload foto)
- [ ] Export laporan absensi ke PDF/Excel
- [ ] Statistik/grafik kehadiran (chart sederhana di dashboard)
- [ ] Notifikasi (email/in-app) saat ada kegiatan baru

## 6. Future Features (TIDAK dikerjakan sekarang, dicatat saja)

- [ ] QR Code untuk absensi otomatis
- [ ] Sistem periode kepengurusan (ganti pengurus tiap tahun ajaran)
- [ ] Sistem proposal & laporan pertandingan resmi
- [ ] Mobile application
- [ ] REST API untuk integrasi eksternal
- [ ] Modul keuangan lengkap (anggaran, laporan keuangan audit-ready)

---

# 7. Core Business Flow

## 7.1 Pembuatan Kegiatan
```text
Admin (dengan permission manage-kegiatan)
   ↓
Membuat kegiatan (latihan/pertandingan/seleksi)
   ↓
Isi: nama, deskripsi, tanggal, lokasi, kuota (jika perlu)
   ↓
Set status: Draft atau langsung Published
   ↓
Jika Published → tampil di halaman publik & terlihat oleh Member
```

## 7.2 Pendaftaran Kegiatan
```text
Member
   ↓
Melihat kegiatan yang published
   ↓
Klik "Daftar"
   ↓
Sistem validasi:
   ├── Sudah terdaftar di kegiatan ini? → jika ya, tolak
   ├── Kegiatan masih menerima pendaftaran (belum ongoing/completed/cancelled)? → jika tidak, tolak
   ├── Kuota masih tersedia (jika kegiatan pakai kuota)? → jika penuh, tolak
   └── Anggota berstatus aktif? → jika tidak aktif, tolak
          ↓
     Pendaftaran berhasil, status: Terdaftar
```

## 7.3 Absensi
```text
Kegiatan berlangsung (status: Ongoing)
        ↓
Admin (permission manage-absensi) membuka daftar peserta terdaftar
        ↓
Mencatat kehadiran per anggota: Hadir / Izin / Sakit / Alpa
        ↓
Data tersimpan, terhubung ke anggota & kegiatan
        ↓
Otomatis masuk ke rekap Laporan
```

## 7.4 Pembatalan Kegiatan
```text
Admin membatalkan kegiatan
   ↓
Status → Cancelled
   ↓
Pendaftaran baru ditolak otomatis
   ↓
Anggota yang sudah terdaftar melihat status "Kegiatan Dibatalkan"
```

---

# 8. Business Rules

## Kegiatan
* Status kegiatan: `draft`, `published`, `ongoing`, `completed`, `cancelled`.
* Kegiatan `completed` atau `cancelled` tidak dapat menerima pendaftaran baru.
* Hanya kegiatan `published` yang tampil di halaman publik.

## Pendaftaran
* Satu anggota tidak dapat mendaftar kegiatan yang sama lebih dari satu kali (unique constraint: `anggota_id` + `kegiatan_id`).
* Pendaftaran ditolak jika kuota penuh (jika kegiatan menetapkan kuota).
* Pendaftaran hanya berlaku untuk anggota berstatus aktif.

## Anggota
* Hanya anggota berstatus **aktif** yang dapat login dan mendaftar kegiatan.
* Anggota nonaktif tetap tersimpan datanya (histori), hanya dibatasi aksesnya.

## Absensi
* Hanya anggota yang terdaftar (status: Terdaftar) pada suatu kegiatan yang bisa memiliki data kehadiran untuk kegiatan itu.
* Satu anggota hanya punya satu data kehadiran per kegiatan (tidak boleh dobel input).

## Permission (Admin)
* Admin hanya bisa mengakses menu sesuai permission yang di-assign Super Admin.
* Super Admin adalah satu-satunya yang bisa mengubah permission Admin lain.

---

# 9. Application Architecture

```text
                         SIBASKET
                              │
              ┌───────────────┴───────────────┐
              │                               │
         PUBLIC WEBSITE                  ADMIN PANEL
         (Guest & Member)          (Super Admin, Admin, Pembina)
              │                               │
          Livewire                         Filament
              │                               │
              └───────────────┬───────────────┘
                              │
                           Laravel
                              │
                    ┌─────────┴─────────┐
                    │                   │
                 Eloquent             MySQL
```

## Public & Member
**Teknologi:** Blade, Livewire, Tailwind CSS
Digunakan untuk: menampilkan data publik, login member, pendaftaran kegiatan, lihat riwayat sendiri.

## Admin & Pembina
**Teknologi:** Filament, Filament Shield (role/permission), Livewire, Laravel
Digunakan untuk: CRUD data, dashboard, tabel & filter, manajemen permission.

---

# 10. Technology Stack

| Bagian | Teknologi |
|---|---|
| Backend | Laravel 11/12 (pakai versi LTS/stable terbaru saat mulai, bukan versi eksperimental) |
| Language | PHP 8.2+ |
| Database | MySQL |
| Public & Member UI | Blade + Livewire |
| Admin/Pembina UI | Filament 3/4 |
| Role & Permission | spatie/laravel-permission + filament-shield |
| CSS | Tailwind CSS |
| Authentication | Laravel Breeze/Fortify (public) + Filament Auth (admin) |
| Version Control | Git + GitHub |
| Deployment | [isi hosting: misal Railway/Niagahoster/shared hosting sekolah] |

> Catatan: pilih versi Laravel & Filament yang **stabil dan sudah rilis resmi** saat kamu mulai coding — cek dokumentasi resmi di titik itu, jangan asumsikan dari template ini.

---

# 11. Database

## Entity Utama (MVP)
```text
User (akun login, punya role)
Role & Permission (Spatie)
Anggota (profil anggota, terhubung ke User)
Kegiatan
Pendaftaran (pivot: Anggota <-> Kegiatan)
Absensi (terhubung ke Pendaftaran atau ke Anggota+Kegiatan)
Pengumuman
```

## Relationship
```text
User
  │
  ├── Role (via Spatie: model_has_roles)
  └── Anggota (1:1, hanya jika role Member)

Anggota
  │
  ├── Pendaftaran (1:N)
  └── Absensi (1:N, via Pendaftaran)

Kegiatan
  │
  ├── Pendaftaran (1:N)
  └── Absensi (1:N)

Pendaftaran
  │
  └── Absensi (1:1, opsional — absensi hanya ada jika sudah terdaftar)
```

## Rancangan Tabel Inti

**`anggota`**
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint FK | Relasi ke tabel users |
| nis / nomor_induk | string | Nomor identitas siswa |
| nama | string | Nama lengkap |
| kelas | string | Kelas saat ini |
| posisi | string, nullable | Posisi di basket (PG/SG/C/dll), opsional |
| status | enum(aktif, nonaktif) | Status keanggotaan |
| tanggal_bergabung | date | |

**`kegiatan`**
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| judul | string | |
| deskripsi | text | |
| tanggal | datetime | |
| lokasi | string | |
| kuota | integer, nullable | null = tanpa batas kuota |
| status | enum(draft, published, ongoing, completed, cancelled) | |

**`pendaftaran`**
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| anggota_id | bigint FK | |
| kegiatan_id | bigint FK | |
| status | enum(terdaftar, dibatalkan) | |
| created_at | timestamp | waktu daftar |

**`absensi`**
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| pendaftaran_id | bigint FK | |
| status_kehadiran | enum(hadir, izin, sakit, alpa) | |
| catatan | text, nullable | |

**`pengumuman`**
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| judul | string | |
| isi | text | |
| tanggal_publish | date | |

---

# 12. UI Pages

## Public
```text
/
├── Home
├── Tentang Eskul
├── Kegiatan
│   └── Detail Kegiatan
├── Pengumuman
│   └── Detail Pengumuman
└── Login
```

## Member
```text
/member
├── Dashboard
├── Kegiatan (lihat & daftar)
├── Pendaftaran Saya
├── Riwayat Kehadiran
└── Profil
```

## Admin & Pembina
```text
/admin
├── Dashboard
├── Anggota
├── Kegiatan
├── Pendaftaran
├── Absensi
├── Pengumuman
├── Laporan
└── Role & Permission (khusus Super Admin)
```

---

# 13. Authorization Matrix

| Fitur | Super Admin | Admin (sesuai permission) | Pembina | Member |
|---|---:|---:|---:|---:|
| Dashboard | ✓ | ✓ | View | ✓ (versi member) |
| Anggota | ✓ | Sesuai permission | View | - |
| Kegiatan | ✓ | Sesuai permission | View | View + Daftar |
| Pendaftaran | ✓ | Sesuai permission | View | Own only |
| Absensi | ✓ | Sesuai permission | View | View (own) |
| Pengumuman | ✓ | Sesuai permission | View | View |
| Laporan | ✓ | Sesuai permission | View | - |
| Role & Permission | ✓ | - | - | - |

---

# 14. Testing Checklist (MVP)

## Authentication
- [ ] Login berhasil per role
- [ ] Login gagal dengan credential salah
- [ ] Logout
- [ ] Guest tidak bisa akses halaman member/admin

## Authorization
- [ ] Admin hanya bisa akses menu sesuai permission-nya
- [ ] Member tidak bisa akses `/admin`
- [ ] Pembina tidak bisa edit/hapus data (read-only benar-benar terkunci)

## Kegiatan
- [ ] Create, Read, Update, Cancel berjalan
- [ ] Status kegiatan berubah dengan benar dan konsisten ke tampilan publik

## Pendaftaran
- [ ] Pendaftaran berhasil untuk kondisi normal
- [ ] Duplicate registration ditolak
- [ ] Kuota penuh → ditolak
- [ ] Kegiatan cancelled/completed → pendaftaran ditolak
- [ ] Anggota nonaktif → tidak bisa daftar

## Absensi
- [ ] Hanya peserta terdaftar yang bisa diabsen
- [ ] Status kehadiran tersimpan & muncul benar di laporan

---

# 15. Roadmap 2 Minggu

> Setiap akhir minggu = checkpoint untuk laporan ke pembina. Update §17 (Project Status) tiap kali checkpoint.

## Minggu 1 — Fondasi + Modul Inti

**Hari 1–2: Setup & Struktur**
- [ ] Setup project Laravel + Filament + Tailwind
- [ ] Setup database & migration dasar
- [ ] Setup autentikasi (Laravel Breeze/Fortify untuk publik, Filament auth untuk admin)
- [ ] Setup role & permission (Spatie + Filament Shield)
- [ ] Buat 4 role dasar: Super Admin, Admin, Pembina, Member

**Hari 3–5: Modul Anggota & Kegiatan**
- [ ] Model, migration, relationship: Anggota, Kegiatan
- [ ] Filament Resource: Manajemen Anggota (CRUD + status aktif/nonaktif)
- [ ] Filament Resource: Manajemen Kegiatan (CRUD + status)
- [ ] Public page: Home, Tentang, Daftar Kegiatan, Detail Kegiatan

**Hari 6–7: Modul Pendaftaran**
- [ ] Model & relationship Pendaftaran
- [ ] Logic validasi pendaftaran (duplikat, kuota, status aktif, status kegiatan)
- [ ] Halaman Member: lihat kegiatan & daftar
- [ ] Filament Resource: lihat data pendaftaran per kegiatan

**📋 Checkpoint Laporan Minggu 1:** demo autentikasi + role, CRUD anggota & kegiatan, alur pendaftaran member berjalan end-to-end.

---

## Minggu 2 — Absensi, Pengumuman, Dashboard, Testing

**Hari 8–9: Modul Absensi**
- [ ] Model & relationship Absensi
- [ ] Filament Resource: input absensi per kegiatan (hadir/izin/sakit/alpa)
- [ ] Halaman Member: riwayat kehadiran sendiri

**Hari 10–11: Pengumuman + Dashboard + Role Pembina**
- [ ] Filament Resource: Manajemen Pengumuman
- [ ] Public page: Pengumuman (list + detail)
- [ ] Dashboard Admin: ringkasan jumlah anggota aktif, kegiatan berjalan, kehadiran terakhir
- [ ] Setup akses Pembina (view-only, pastikan tombol edit/hapus benar-benar hilang, bukan cuma disembunyikan di UI tapi juga dicegah di backend)

**Hari 12: Laporan Sederhana**
- [ ] Halaman/laporan rekap kehadiran per anggota & per kegiatan

**Hari 13: Testing & Perbaikan**
- [ ] Jalankan seluruh Testing Checklist (§14)
- [ ] Perbaiki bug yang ditemukan
- [ ] Cek ulang authorization tiap role

**Hari 14: Deployment & Laporan Akhir**
- [ ] Deploy ke hosting
- [ ] Data dummy/testing dibersihkan, isi data awal yang sebenarnya
- [ ] Siapkan laporan akhir + demo untuk pembina

**📋 Checkpoint Laporan Minggu 2 (Final):** seluruh MVP berjalan di server, demo lengkap semua role.

> Jika di tengah jalan ternyata ada modul yang meleset dari estimasi, prioritaskan menyelesaikan modul di §4 (MVP) dulu dan pindahkan sisanya ke §5/§6 — jangan korbankan modul inti demi mengejar fitur Optional.

---

# 16. Weekly Report Template (untuk pembina)

> Salin bagian ini tiap minggu, isi, dan serahkan sebagai laporan progres.

```text
LAPORAN MINGGU KE- [1/2]
Tanggal: [dd/mm/yyyy] – [dd/mm/yyyy]

1. Yang sudah selesai minggu ini:
   - ...
   - ...

2. Yang sedang dikerjakan:
   - ...

3. Kendala yang ditemui:
   - ...

4. Rencana minggu depan:
   - ...

5. Persentase progres MVP: __%  (dari checklist §4)
```

---

# 17. Project Status

| Module | Priority | Status |
|---|---|---|
| Authentication & Role | High | ⬜ |
| Anggota | High | ⬜ |
| Kegiatan | High | ⬜ |
| Pendaftaran | High | ⬜ |
| Absensi | High | ⬜ |
| Pengumuman | Medium | ⬜ |
| Dashboard | Medium | ⬜ |
| Laporan | Medium | ⬜ |
| Deployment | High | ⬜ |
| Keuangan (Optional) | Low | ⬜ |
| Galeri (Optional) | Low | ⬜ |
| QR Absensi (Future) | Future | ⬜ |

---

# 18. Definition of Done

Sebuah fitur MVP dianggap selesai apabila:
- [ ] Database & relationship sudah benar
- [ ] Validasi & business rules (§8) sudah berjalan
- [ ] Authorization per role sudah diuji (bukan cuma diasumsikan benar)
- [ ] UI bisa dipakai tanpa error oleh non-developer
- [ ] Edge case di §14 sudah dicek
- [ ] Kamu (developer) bisa menjelaskan cara kerja fitur ini tanpa membaca ulang kode

---

# 19. Changelog

## v0.1 — [Tanggal mulai]
* Initial planning, adaptasi dari template umum ke kebutuhan Eskul Basket.
* Keputusan: Admin pakai 1 role dengan permission granular, bukan role terpisah per jabatan.
* Scope MVP ditentukan untuk target 2 minggu.

## v0.2 — [Tanggal]
* [Isi perubahan scope/keputusan di sini setiap kali ada perubahan]

---

# 20. Notes

```text
[TANGGAL]
Keputusan:
...

Alasan:
...

Dampak ke scope/timeline:
...
```
