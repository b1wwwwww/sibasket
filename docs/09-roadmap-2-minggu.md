# 09. Roadmap 2 Minggu

[← Kembali ke index](./00-README.md)

> Setiap akhir minggu = checkpoint untuk laporan ke pembina (`10-weekly-report-template.md`).
> Update `11-project-status-dan-definition-of-done.md` tiap kali checkpoint.

---

## Minggu 1 — Fondasi + Modul Inti

### Hari 1–2: Setup & Struktur
- [ ] Setup project Laravel + Filament + Tailwind
- [ ] Setup database & migration dasar
- [ ] Setup autentikasi (Laravel Breeze/Fortify untuk publik, Filament auth untuk admin)
- [ ] Setup role & permission (Spatie + Filament Shield)
- [ ] Buat 4 role dasar: Super Admin, Admin, Pembina, Member

### Hari 3–5: Modul Anggota & Kegiatan
- [ ] Model, migration, relationship: Anggota, Kegiatan
- [ ] Filament Resource: Manajemen Anggota (CRUD + status aktif/nonaktif)
- [ ] Filament Resource: Manajemen Kegiatan (CRUD + status)
- [ ] Public page: Home, Tentang, Daftar Kegiatan, Detail Kegiatan

### Hari 6–7: Modul Pendaftaran Kegiatan
- [ ] Model & relationship PendaftaranKegiatan
- [ ] Logic validasi pendaftaran (duplikat, kuota, status aktif, status kegiatan)
- [ ] Halaman Member: lihat kegiatan & daftar
- [ ] Filament Resource: lihat data pendaftaran per kegiatan

**📋 Checkpoint Laporan Minggu 1:** demo autentikasi + role, CRUD anggota & kegiatan,
alur pendaftaran kegiatan member berjalan end-to-end.

> ⚠️ **Catatan penyesuaian scope:** modul **Pendaftaran Anggota Baru** (§4.3 di
> `04-business-flow-dan-rules.md`) ditambahkan setelah roadmap awal ini dibuat.
> Karena hari 1–7 sudah padat dengan fondasi + modul inti, kerjakan modul ini di
> **Hari 8** (lihat Minggu 2 di bawah), sebelum masuk ke Absensi. Kalau ternyata
> waktu tidak cukup, modul ini boleh digeser ke akhir Minggu 2 asal tidak
> mengorbankan modul MVP inti lain (lihat aturan prioritas di bagian bawah file ini).

---

## Minggu 2 — Keuangan, Pengumuman, Dashboard, Testing

> **UPDATE (04 Oktober 2026):** Berdasarkan keputusan v0.3, urutan diprioritaskan ulang.
> Modul Keuangan naik menjadi prioritas HIGH (langsung setelah Absensi).
> Pendaftaran Anggota Baru digeser ke Optional/Minggu 3.

### Hari 8–9: Modul Keuangan (Backend Bendahara)
- [ ] Migration tabel `transaksi_kas` & `kas_rutin_config`
- [ ] Model & relationship TransaksiKas, KasRutinConfig
- [ ] Filament Resource: CRUD Pemasukan/Pengeluaran (dengan status: lunas/nunggak/pending)
- [ ] Dashboard widget Bendahara: Saldo hari ini, Pemasukan bulan ini, Pengeluaran bulan ini
- [ ] Tracking pembayaran kas: siapa yang sudah bayar vs. nunggak (dropdown Anggota)
- [ ] Format nominal jadi Rupiah, badge warna status (lunas=hijau, nunggak=merah, pending=kuning)
- [ ] Navigation group "Keuangan" di sidebar Filament (terpisah dari Anggota/Kegiatan)

### Hari 10: Modul Pengumuman + Dashboard Utama
- [ ] Filament Resource: Manajemen Pengumuman (CRUD)
- [ ] Public page: Daftar Pengumuman & Detail
- [ ] Dashboard Admin: widget ringkasan (Total Anggota Aktif, Kegiatan Bulan Ini, Saldo Kas, Pendaftar Pending)
- [ ] Setup akses Pembina (view-only, pastikan tombol edit/hapus benar-benar hilang,
      bukan cuma disembunyikan di UI tapi juga dicegah di backend)

### Hari 11–12: Laporan Export + Testing
- [ ] Export absensi ke Excel (per kegiatan)
- [ ] Export laporan keuangan ke PDF/Excel (Bendahara)
- [ ] Jalankan seluruh Testing Checklist (`08-testing-checklist.md`)
- [ ] Perbaiki bug yang ditemukan
- [ ] Cek ulang authorization tiap role (khususnya Bendahara & Pembina)

### Hari 13: Testing Final & Refinement
- [ ] Full regression test semua modul (Anggota, Kegiatan, Pendaftaran Kegiatan, Absensi, Keuangan, Pengumuman)
- [ ] Manual testing di environment staging
- [ ] Dokumentasi final & checklist

### Hari 14: Deployment & Laporan Akhir
- [ ] Deploy ke hosting
- [ ] Data dummy/testing dibersihkan, isi data awal yang sebenarnya
- [ ] Siapkan laporan akhir + demo untuk pembina

**📋 Checkpoint Laporan Minggu 2 (Final):** MVP lengkap berjalan di server (foundasi + 
Anggota + Kegiatan + Pendaftaran Kegiatan + Absensi + Keuangan + Pengumuman + Dashboard), 
demo lengkap semua role.

> **Pendaftaran Anggota Baru (Form Publik)** ditunda ke fase Optional/Minggu 3 atau 
> maintenance phase — kecuali pembina request jadi prioritas. Lihat `12-changelog-dan-notes.md` 
> v0.3 untuk konteks keputusan ini.

---

> **Aturan prioritas:** kalau di tengah jalan ternyata ada modul yang meleset dari
> estimasi, prioritaskan menyelesaikan modul MVP (`03-scope-dan-mvp.md`) dulu dan
> pindahkan sisanya ke Optional/Future — jangan korbankan modul inti demi mengejar
> fitur tambahan.
