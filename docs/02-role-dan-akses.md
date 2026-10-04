# 02. Role & Struktur Akses

[← Kembali ke index](./00-README.md)

---

Struktur akses dibuat **4 role dasar**, dengan Admin memakai **permission granular per menu** (bukan role terpisah untuk tiap posisi pengurus). Ini dipilih supaya struktur pengurus asli (ketua, bendahara, sie absensi, dll) tetap terwakili tanpa menambah kompleksitas otorisasi yang tidak sepadan dengan waktu 2 minggu.

## 2.1 Super Admin
Kamu sebagai developer / penanggung jawab sistem.
* Full access ke seluruh modul.
* Mengelola akun pengurus (Admin) dan meng-assign permission ke masing-masing.
* Mengelola role & permission itu sendiri.

## 2.2 Admin (Pengurus Eskul)
Satu role "Admin", tapi tiap akun Admin diberi kombinasi **permission** sesuai jabatannya di eskul:

| Jabatan Asli | Permission yang di-assign |
|---|---|
| Ketua | `manage-anggota`, `manage-kegiatan`, `manage-absensi`, `manage-pengumuman`, `view-laporan` (hampir full) |
| Wakil Ketua | sama seperti Ketua, atau subset sesuai kebutuhan |
| Sekretaris | `manage-anggota`, `manage-pengumuman` |
| Bendahara | `manage-keuangan` *(masuk Optional/Future, lihat `03-scope-dan-mvp.md`)* |
| Sie Absensi | `manage-absensi` |
| Sie Acara/Kegiatan | `manage-kegiatan` |

Permission dikelola lewat 1 sistem (`spatie/laravel-permission` + `filament-shield`), sehingga menambah/mengurangi akses jabatan baru tidak perlu ubah struktur sistem, cukup atur assignment.

## 2.3 Pembina
* Akses **view-only** ke seluruh data: anggota, kegiatan, absensi, laporan.
* Tidak bisa mengubah/menghapus data apa pun.
* Ini role yang akan dipakai pembina kamu untuk memantau progres aplikasi juga.

## 2.4 Member (Anggota Eskul)
* Login dengan akun sendiri.
* Melihat jadwal kegiatan, mendaftar kegiatan, melihat riwayat kehadiran & pendaftaran sendiri.
* Tidak bisa melihat data anggota lain.

## 2.5 Guest (Belum Login)
* Melihat halaman publik: info eskul, jadwal/kegiatan yang dipublish, pengumuman, galeri (jika sempat).
* **Submit form Pendaftaran Anggota Baru** — satu-satunya aksi "tulis" yang boleh
  dilakukan Guest di seluruh sistem. Setelah di-approve Admin, Guest ini berubah
  menjadi Member dengan akun yang dibuat otomatis (lihat `04-business-flow-dan-rules.md` §4.3).

> Matriks otorisasi lengkap per fitur ada di `07-ui-pages-dan-authorization.md`.
