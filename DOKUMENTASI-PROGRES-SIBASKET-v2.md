# Dokumentasi Progres SIBASKET (v2) - UPDATED

> File ini adalah sumber kebenaran (source of truth) progres pembangunan SIBASKET.
> Terakhir diupdate: 03 Oktober 2026 (WIB) - Modul Absensi Selesai (Input Manual + Recap).

---

## 1. Environment & Tech Stack
- **Backend:** Laravel 13
- **Admin Panel:** Filament 5
- **Role & Permission:** Spatie Laravel-Permission + Filament Shield
- **Database:** MariaDB/MySQL (`sibasket`)

---

## 2. Struktur Role & Permission (Final)
Permission dikelola secara granular per jabatan admin:

| Jabatan | Permission Key |
|---|---|
| **Ketua / Wakil** | `manage-anggota`, `manage-kegiatan`, `manage-absensi`, `manage-pengumuman`, `view-laporan`, `view-keuangan` |
| **Sekretaris** | `manage-anggota`, `manage-pengumuman`, `manage-kegiatan` |
| **Bendahara** | `manage-keuangan` (Pemasukan, Pengeluaran, Kas Rutin, Recap) |
| **Sie Absensi** | `manage-absensi` |
| **Pembina** | `view-only` (semua modul, tidak bisa edit/hapus) |
| **Member** | Akses Dashboard Member, Daftar Kegiatan, Riwayat Kehadiran |

---

## 3. Roadmap Pengerjaan (Updated: 20 Hari)

### ✅ MINGGU 1: FONDASI & MODUL INTI (Selesai)
- [x] Setup Laravel + Filament + Shield
- [x] CRUD Anggota
- [x] CRUD Kegiatan (Event)
- [x] Modul Pendaftaran Kegiatan (Admin Side)

### 🔨 MINGGU 2: VALIDASI & FITUR TAMBAHAN (Sebagian Selesai)
- **Hari 6-7: Refinement Pendaftaran Kegiatan (Option B)** ✅ SELESAI
    - [x] Filter by Kegiatan di tabel pendaftaran
    - [x] Column info kuota sisa (contoh: "15 / 20")
    - [x] Default sort terbaru (LIFO)
    - [x] Bulk action "Cancel Registration" (ubah status jadi dibatalkan)
- **Hari 8: Modul Pendaftaran Anggota Baru** ⏳ BELUM
    - [ ] Form Publik (Guest access) - *Menunggu desain visual*
    - [ ] Admin Review (Approve/Reject)
    - [ ] Logic Auto-generate Akun (Username=NIS, Pass=NIS+Random)
- **Hari 9: Modul Absensi** ✅ SELESAI
    - [x] Input kehadiran per kegiatan (Hadir/Izin/Sakit/Alpa)
    - [x] Recap kehadiran per anggota
- **Hari 10-11: Pengumuman & Dashboard Admin** ⏳ BELUM
    - [ ] CRUD Pengumuman
    - [ ] Dashboard Widgets (Total Anggota, Kegiatan Aktif, Pendaftar Baru Pending)

### 💰 MINGGU 3: KEUANGAN & EXPORT (Belum Dimulai)
- **Hari 12-14: Modul Keuangan (Bendahara)**
    - [ ] Tabel `transaksi_kas` & `jadwal_kas_rutin`
    - [ ] Dashboard Bendahara (Recap Mingguan, Bulanan, Total)
    - [ ] Tracking Pembayaran Kas (Siapa sudah bayar, siapa nunggak)
- **Hari 15: Modul Export (PDF/Excel)**
    - [ ] Export Absensi per Kegiatan (Excel)
    - [ ] Export Laporan Keuangan (PDF/Excel)
- **Hari 16-18: Final Testing & Bugfixing**
    - [ ] Testing alur keuangan & permission tiap jabatan
- **Hari 19-20: Deployment & Handover**

---

## 4. Draft Database Keuangan (Design Plan)

### Tabel: `transaksi_kas`
- `id`: primary key
- `anggota_id`: FK -> anggota (siapa yang bayar/pengeluaran untuk siapa)
- `nominal`: decimal (jumlah uang)
- `jenis`: enum (pemasukan, pengeluaran)
- `kategori`: string (Kas Mingguan, Iuran Event, Alat, dll)
- `status`: enum (lunas, nunggak, pending)
- `tanggal_bayar`: date
- `keterangan`: text

### Tabel: `kas_rutin_config`
- `nominal_wajib`: decimal (misal: 5000)
- `frekuensi`: string (mingguan)

---

## 5. Keputusan Desain (Pendaftaran Kegiatan - Option B)
1. **Kuota Sisa:** Ditampilkan di tabel admin dengan format "Terdaftar / Kuota" (misal: `12 / 20`). Jika kuota NULL, tampilkan `12 / ∞`.
2. **Bulk Action:** Menghindari penghapusan permanen. Gunakan status `dibatalkan` agar histori tetap ada.
3. **Sorting:** Halaman list admin otomatis menampilkan pendaftaran yang paling baru masuk di paling atas.

---

## 6. Fokus Pengerjaan Saat Ini (03 Oktober 2026)

### Keputusan Strategis
- **TIDAK membuat halaman publik/frontend** pada fase ini (kecuali Form Pendaftaran Anggota Baru jika diperlukan).
- **FOKUS pada backend logika + Filament Admin Panel** agar sistem siap digunakan sepenuhnya oleh pengurus saat hosting.
- Semua modul yang tersisa adalah fitur internal untuk admin/pengurus di `/admin`.

### Sisa Backend / Logika Utama (Tanpa Halaman Publik)
1. ✅ **Modul Absensi (Input Manual Admin):**
   - Halaman admin untuk mencatat absensi anggota per kegiatan (Hadir, Izin, Sakit, Alpa).
   - Rekapitulasi absensi untuk melihat persentase kehadiran per anggota.

2. ✅ **Modul Keuangan (Backend Bendahara):**
   - CRUD Pemasukan/Pengeluaran kas di Filament.
   - Tracking siapa saja yang sudah bayar kas vs yang menunggak.
   - Rekap saldo kas otomatis (mingguan, bulanan, total).

3. ✅ **Dashboard Widgets:**
   - Menampilkan statistik ringkas (Total Anggota aktif, Kegiatan bulan ini, Saldo Kas, Pendaftar pending).

4. ⚠️ **Auto-Generate Akun Member (Opsional):**
   - Saat admin meng-approve pendaftaran anggota baru, sistem otomatis membuat user akun dengan role `Member`.

---

## 7. Penjelasan Login & Deployment Filament

### Bagaimana Login Filament Saat Hosted Online?

#### A. Arsitektur Halaman
- **Halaman Publik:** `https://sibasket.com/` (Profil, galeri, jadwal - akses bebas, tidak perlu login).
- **Halaman Admin Panel:** `https://sibasket.com/admin/` (Hanya untuk pengurus yang sudah login).
- **Halaman Login Admin:** `https://sibasket.com/admin/login` (Calon pengurus memasukkan email & password).

#### B. Alur Login & Permission Check
1. Pengurus membuka `https://sibasket.com/admin/login` dan memasukkan email + password.
2. Sistem mengecek kredensial di tabel `users`.
3. Jika valid, sistem lanjut mengecek **Role & Permission** menggunakan Spatie + Filament Shield.
4. **Menu sidebar akan disesuaikan otomatis:**
   - **Bendahara** → Hanya melihat menu "Keuangan" (CRUD Transaksi, Recap).
   - **Sie Absensi** → Hanya melihat menu "Absensi".
   - **Ketua** → Melihat menu Anggota, Kegiatan, Absensi, Keuangan (read-only), Pengumuman.
   - **Super Admin** → Semua menu terbuka.

#### C. Saat Pertama Deploy ke Hosting
1. Deploy project ke server/hosting (Git push atau manual upload).
2. SSH ke server dan jalankan migrasi: `php artisan migrate --force`.
3. Buat Super Admin pertama: `php artisan shield:super-admin` atau seeding via `php artisan db:seed`.
4. Akses `/admin/login` dan login dengan akun Super Admin tersebut.
5. Dari situ, buat akun-akun pengurus lain (Bendahara, Sie Absensi, Ketua) langsung dari Filament (Resource User).

### Keamanan & Akses
- **Hanya pengurus dengan akun** yang bisa login ke `/admin`.
- **Guest/Anggota Biasa** hanya bisa melihat halaman publik (jika ada).
- Filament secara otomatis mengalihkan request ke `/login` jika user belum terautentikasi.

---

## 8. Prioritas Pengerjaan Fase Selanjutnya (Backend-Only)

### Urutan Rekomendasi:
1. **Hari 1-2: Modul Absensi (Backend)**
   - Migration tabel `absensi` (sudah ada, tapi perlu validasi struktur).
   - Resource Absensi di Filament dengan tabel & form yang user-friendly.
   - Fitur filter per Kegiatan, sort terbaru.
   - Rekapitulasi absensi (siapa paling rajin, paling sering bolos).

2. **Hari 3-4: Modul Keuangan (Backend)**
   - Migration tabel `transaksi_kas` & `kas_rutin_config`.
   - Resource Keuangan di Filament (CRUD Transaksi, Kas Rutin Config).
   - Dashboard widget Bendahara (Saldo hari ini, Pemasukan bulan ini, Pengeluaran bulan ini).
   - Fitur export laporan keuangan ke Excel/PDF.

3. **Hari 5: Dashboard Widgets & Finishing**
   - Tambahkan widget di dashboard utama Filament.
   - Bugfixing & testing permission tiap role.
   - Validasi bahwa setiap jabatan admin hanya bisa akses menu yang sesuai.

---

## 9. Status Progress Terkini (03 Oktober 2026 - UPDATED)

| Fitur | Status | Catatan |
|---|---|---|
| Setup Laravel + Filament + Shield | ✅ Selesai | Fondasi sudah solid. |
| CRUD Anggota | ✅ Selesai | Manajemen data anggota lengkap. |
| CRUD Kegiatan | ✅ Selesai | Manajemen event/latihan. |
| Pendaftaran Kegiatan (Admin) | ✅ Selesai | Filter, kuota, bulk action sudah ok. |
| **Modul Absensi (Backend)** | ✅ **SELESAI** | Input manual + Recap absensi per anggota. |
| **Keuangan (Backend)** | 🔨 NEXT | Perlu migration + Filament Resource. |
| **Dashboard Widgets** | ⏳ Menunggu | Setelah Keuangan selesai. |
| Pendaftaran Anggota Baru (Form Publik) | ❓ Optional | Setelah backend utama selesai. |
| Export PDF/Excel | ⏳ Menunggu | Setelah Keuangan selesai. |
| Deployment & Handover | ⏳ Belum | Setelah semua fitur selesai & testing ok. |

---

## 10. Detail Fitur Modul Absensi (SELESAI)

### Arsitektur & Desain
- **Database Relation:** Absensi → PendaftaranKegiatan → (Anggota + Kegiatan)
- **Unique Constraint:** Satu anggota hanya punya satu status kehadiran per kegiatan (tidak ada duplicate).
- **Cascade Delete:** Jika pendaftaran dihapus, absensi otomatis ikut terhapus.

### File-file yang Dibuat:
1. **Form Input (AbsensiForm.php):**
   - Select Pendaftar (dropdown: "Nama Anggota - Judul Kegiatan")
   - Select Status Kehadiran (Hadir, Izin, Sakit, Alpa)
   - Textarea Catatan (opsional)

2. **Tabel Absensi (AbsensisTable.php):**
   - Kolom: Nama Anggota, Kegiatan, Tanggal Kegiatan, Status (badge warna), Catatan
   - Filter: Berdasarkan status kehadiran
   - Default Sort: Terbaru (LIFO - Last In First Out)
   - Color Coding:
     - Hijau (Hadir)
     - Biru (Izin)
     - Kuning (Sakit)
     - Merah (Alpa)

3. **Resource Absensi (AbsensiResource.php):**
   - Navigation Label: "Absensi"
   - Icon: ClipboardDocumentCheck (clipboard)
   - Pages: index (list), create, edit, recap

4. **Halaman Recap Absensi (RecapAbsensi.php):**
   - Tabel ringkasan kehadiran seluruh anggota
   - Kolom: Nama Anggota, Total Kegiatan, Hadir, Izin, Sakit, Alpa
   - Menampilkan persentase kehadiran per anggota
   - Mudah di-sort dan filter untuk identifikasi anggota yang sering absen

5. **View Blade (recap-absensi.blade.php):**
   - Layout Filament panel standard
   - Helper text: "Berikut adalah rekapitulasi kehadiran seluruh anggota..."

### Fitur yang Sudah Berjalan:
- ✅ Input manual kehadiran per kegiatan (Sie Absensi tinggal pilih anggota + status)
- ✅ Filter status kehadiran di list absensi
- ✅ Recap otomatis (menghitung jumlah hadir/izin/sakit/alpa per anggota)
- ✅ Warna badge untuk quick scan status
- ✅ Catatan audit trail (created_at, updated_at)

### Testing:
Cukup akses `/admin` → Sidebar "Absensi" → ada 2 tab:
- **List Absensi:** Untuk input/edit kehadiran.
- **Recap Absensi:** Untuk lihat ringkasan persentase kehadiran semua anggota.

---

## 11. Sisa Pekerjaan & Roadmap Setelah Absensi

### ✅ Selesai:
- [x] Modul Absensi (Input Manual + Recap)

### 🔨 Selanjutnya:
- **Modul Keuangan (Prioritas Utama):**
  - [ ] Migration tabel `transaksi_kas` & `kas_rutin_config`
  - [ ] CRUD Pemasukan/Pengeluaran di Filament
  - [ ] Tracking kas yang sudah bayar vs nunggak
  - [ ] Dashboard widget Bendahara (Recap saldo)
  - [ ] Export laporan keuangan (Excel/PDF)

- **Dashboard Widgets (UI):**
  - [ ] Widget statistik di halaman utama admin
  - [ ] Total Anggota Aktif
  - [ ] Total Kegiatan Bulan Ini
  - [ ] Saldo Kas Hari Ini
  - [ ] Pendaftar Baru Pending

### ❓ Optional / Belakangan:
- Pendaftaran Anggota Baru (Form Publik)
- Auto-generate akun Member saat approve pendaftaran

---
