# 01. Overview & Problem Statement

[← Kembali ke index](./00-README.md)

---

## 1. Overview

### 1.1 Deskripsi

SIBASKET adalah aplikasi berbasis web untuk membantu pengurus Eskul Basket dalam mengelola keanggotaan, jadwal latihan/pertandingan, pendaftaran kegiatan, absensi, dan pengumuman, secara terpusat — menggantikan cara manual (grup WhatsApp, catatan kertas, Excel terpisah).

Aplikasi terdiri dari:

* **Public Website** — dapat diakses siapa saja (calon anggota, siswa, orang tua) tanpa login.
* **Management System (Admin Panel)** — digunakan oleh pengurus eskul dan pembina untuk mengelola data.
* **Member Area** — digunakan oleh anggota eskul yang sudah terdaftar.

### 1.2 Tujuan

1. Memusatkan data anggota, jadwal, dan kehadiran dalam satu sistem, menggantikan pencatatan manual/tersebar.
2. Mempermudah proses pendaftaran kegiatan (latihan, pertandingan, seleksi) secara online dengan validasi otomatis (kuota, status aktif, duplikasi).
3. Memberikan visibilitas kepada pembina atas kondisi eskul (jumlah anggota aktif, tingkat kehadiran, kegiatan berjalan) tanpa harus menghubungi pengurus satu per satu.
4. Menyediakan laporan mingguan yang bisa diserahkan ke pembina sebagai bukti progres pengerjaan sekaligus bukti manfaat aplikasi bagi organisasi.

---

## 2. Problem Statement

| No | Masalah | Kondisi Saat Ini | Solusi |
|----|---------|-------------------|--------|
| 1 | Data anggota tersebar (grup WA, catatan manual) | Pengurus sulit tahu siapa saja anggota aktif | Modul Manajemen Anggota terpusat |
| 2 | Absensi latihan dicatat manual di kertas/buku | Rawan hilang, sulit direkap untuk laporan | Modul Absensi digital per kegiatan |
| 3 | Pendaftaran kegiatan/seleksi lewat chat, rawan salah data & duplikat | Pengurus harus rekap manual dari chat | Modul Pendaftaran Kegiatan dengan validasi otomatis |
| 4 | Pengumuman eskul (jadwal, hasil seleksi) tersebar di berbagai grup | Info sering terlambat sampai/tidak konsisten | Modul Pengumuman terpusat di web publik |

> **Catatan:** Isi ulang tabel ini setelah kamu ngobrol singkat dengan ketua/pengurus eskul beneran — ini contoh masalah umum eskul olahraga, sesuaikan dengan kondisi asli di sekolahmu supaya laporan ke pembina lebih kuat (bukan asumsi kamu sendiri).
