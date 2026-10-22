# 02. Role & Struktur Akses

[← Kembali ke index](./00-README.md)

---

Struktur akses dibuat **5 role utama** dengan permission granular berbasis Spatie Laravel Permission.

## 2.1 Super Admin
Kamu sebagai developer / penanggung jawab sistem.
* Full access ke seluruh modul.
* Mengelola akun pengurus lainnya.
* Mengelola role & permission itu sendiri.

## 2.2 Ketua
Ketua Eskul / Koordinator Utama.

| Akses | Fitur |
|---|---|
| ✓ CRUD | Anggota |
| ✓ CRUD | Kegiatan |
| ✓ CRUD | Pendaftaran Kegiatan (view per kegiatan) |
| ✓ CRUD | Pengumuman |
| ✓ View | Laporan & Export |
| ✗ | Keuangan, Absensi (tidak punya akses) |

## 2.3 Bendahara
Bendahara Eskul / Pengelola Keuangan.

| Akses | Fitur |
|---|---|
| ✓ CRUD | Keuangan (Transaksi Kas) |
| ✓ CRUD | Anggota (untuk cek siapa belum bayar) |
| ✓ CRUD | Pengumuman |
| ✓ View | Laporan & Export |
| ✗ | Kegiatan, Absensi, Pendaftaran Kegiatan |

## 2.4 Absensi/Sekretaris
Sie Absensi atau Sekretaris Eskul.

| Akses | Fitur |
|---|---|
| ✓ CRUD | Absensi (input, bulk action, rekap) |
| ✓ CRUD | Anggota (termasuk nambah anggota) |
| ✓ CRUD | Kegiatan |
| ✓ CRUD | Pendaftaran Kegiatan |
| ✓ CRUD | Pengumuman |
| ✓ View | Laporan & Export |
| ✗ | Keuangan |

## 2.5 Pembina
Guru Pembina / Perwakilan Sekolah.

* Akses **view-only** ke seluruh data: anggota, kegiatan, absensi, pengumuman, keuangan, laporan.
* Tidak bisa mengubah/menghapus data apa pun.
* Role untuk monitoring dan audit trail.

## 2.6 Member (Anggota Eskul)
* Login dengan akun sendiri.
* Melihat jadwal kegiatan, mendaftar kegiatan, melihat riwayat kehadiran & pendaftaran sendiri.
* Tidak bisa melihat data anggota lain.

## 2.7 Guest (Belum Login)
* Melihat halaman publik: info eskul, jadwal/kegiatan yang dipublish, pengumuman.
* **Submit form Pendaftaran Anggota Baru** — satu-satunya aksi "tulis" yang boleh
  dilakukan Guest di seluruh sistem. Setelah di-approve Admin, Guest ini berubah
  menjadi Member dengan akun yang dibuat otomatis (lihat `04-business-flow-dan-rules.md` §4.3).

> Matriks otorisasi lengkap per fitur ada di `07-ui-pages-dan-authorization.md`.
