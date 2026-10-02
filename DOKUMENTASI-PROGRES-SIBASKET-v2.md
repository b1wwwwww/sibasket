# Dokumentasi Progres SIBASKET (v2) - UPDATED

> File ini adalah sumber kebenaran (source of truth) progres pembangunan SIBASKET.
> Terakhir diupdate: 02 Oktober 2026 (WIB) - Penambahan Modul Keuangan & Export.

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

### 🔨 MINGGU 2: VALIDASI & FITUR TAMBAHAN (Sedang Berjalan)
- **Hari 6-7: Refinement Pendaftaran Kegiatan (Option B)**
    - [ ] Filter by Kegiatan di tabel pendaftaran
    - [ ] Column info kuota sisa (contoh: "15 / 20")
    - [ ] Default sort terbaru (LIFO)
    - [ ] Bulk action "Cancel Registration" (ubah status jadi dibatalkan)
- **Hari 8: Modul Pendaftaran Anggota Baru**
    - [ ] Form Publik (Guest access) - *Menunggu desain visual*
    - [ ] Admin Review (Approve/Reject)
    - [ ] Logic Auto-generate Akun (Username=NIS, Pass=NIS+Random)
- **Hari 9: Modul Absensi**
    - [ ] Input kehadiran per kegiatan (Hadir/Izin/Sakit/Alpa)
    - [ ] Recap kehadiran per anggota
- **Hari 10-11: Pengumuman & Dashboard Admin**
    - [ ] CRUD Pengumuman
    - [ ] Dashboard Widgets (Total Anggota, Kegiatan Aktif, Pendaftar Baru Pending)

### 💰 MINGGU 3: KEUANGAN & EXPORT (New Extension)
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
