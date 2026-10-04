# 03. Scope, MVP, Optional & Future Features

[← Kembali ke index](./00-README.md)

---

## 3.1 MVP — WAJIB selesai dalam 2 minggu

> Ini adalah kontrak scope kamu. Kalau pembina minta tambahan di luar ini, catat di
> `12-changelog-dan-notes.md` sebagai perubahan scope, jangan diam-diam dikerjakan —
> supaya deadline tetap bisa dipertanggungjawabkan.
>
> **UPDATE (04 Oktober 2026):** Modul Keuangan dimajukan dari Optional → MVP HIGH priority.
> Pendaftaran Anggota Baru digeser ke Optional (lihat v0.3 di `12-changelog-dan-notes.md`).

### Public (Guest)
- [ ] Home (info singkat eskul)
- [ ] Tentang Eskul
- [ ] Daftar Kegiatan (jadwal latihan/pertandingan yang dipublish)
- [ ] Detail Kegiatan
- [ ] Pengumuman (list + detail)
- [ ] Login

### Admin (Super Admin + Admin)
- [ ] Login & Dashboard (ringkasan: jumlah anggota aktif, kegiatan berjalan, tingkat kehadiran terakhir, saldo kas)
- [ ] Manajemen Anggota (CRUD + status aktif/nonaktif) ✅
- [ ] Manajemen Kegiatan (CRUD + status: draft/published/ongoing/completed/cancelled) ✅
- [ ] Manajemen Pendaftaran Kegiatan (lihat siapa saja yang daftar per kegiatan) ✅
- [ ] Manajemen Absensi (input kehadiran per kegiatan: Hadir/Izin/Sakit/Alpa) ✅
- [ ] **Manajemen Keuangan** (CRUD Pemasukan/Pengeluaran, tracking pembayaran kas, status lunas/nunggak/pending) 🟨
- [ ] Manajemen Pengumuman (CRUD)
- [ ] Manajemen Role & Permission (khusus Super Admin — assign permission ke Admin)
- [ ] Laporan & Export (rekap kehadiran per anggota/kegiatan, laporan keuangan ke PDF/Excel)

### Pembina
- [ ] Login & Dashboard (view-only, sama seperti dashboard admin tapi read-only)
- [ ] Lihat Anggota, Kegiatan, Absensi, Keuangan, Laporan (tanpa tombol edit/hapus)

### Member
- [ ] Login
- [ ] Lihat & daftar kegiatan
- [ ] Lihat riwayat pendaftaran sendiri
- [ ] Lihat riwayat kehadiran sendiri
- [ ] Edit profil dasar

---

## 3.2 Optional Features (dikerjakan HANYA jika MVP selesai lebih cepat)

- [ ] **Pendaftaran Anggota Baru** (Form publik permanen + auto-generate akun saat approve)
- [ ] Galeri dokumentasi kegiatan (upload foto)
- [ ] Statistik/grafik kehadiran (chart sederhana di dashboard)
- [ ] Notifikasi (email/in-app) saat ada kegiatan baru

## 3.3 Future Features (TIDAK dikerjakan sekarang, dicatat saja)

- [ ] QR Code untuk absensi otomatis
- [ ] Sistem periode kepengurusan (ganti pengurus tiap tahun ajaran)
- [ ] Sistem proposal & laporan pertandingan resmi
- [ ] Mobile application
- [ ] REST API untuk integrasi eksternal
- [ ] Modul keuangan lengkap (anggaran, laporan keuangan audit-ready)

---

> Kalau di tengah jalan ternyata ada modul MVP yang meleset dari estimasi waktu,
> **jangan korbankan modul inti demi mengejar fitur Optional** — lihat panduan
> prioritas di `09-roadmap-2-minggu.md`.
