# 08. Testing Checklist (MVP)

[← Kembali ke index](./00-README.md)

---

## Authentication
- [ ] Login berhasil per role
- [ ] Login gagal dengan credential salah
- [ ] Logout
- [ ] Guest tidak bisa akses halaman member/admin

## Authorization
- [ ] Admin hanya bisa akses menu sesuai permission-nya
- [ ] Member tidak bisa akses `/admin`
- [ ] Pembina tidak bisa edit/hapus data (read-only benar-benar terkunci, bukan cuma
      tombol disembunyikan di UI)

## Kegiatan
- [ ] Create, Read, Update, Cancel berjalan
- [ ] Status kegiatan berubah dengan benar dan konsisten ke tampilan publik

## Pendaftaran Kegiatan
- [ ] Pendaftaran berhasil untuk kondisi normal
- [ ] Duplicate registration ditolak
- [ ] Kuota penuh → ditolak
- [ ] Kegiatan cancelled/completed → pendaftaran ditolak
- [ ] Anggota nonaktif → tidak bisa daftar

## Absensi
- [ ] Hanya peserta terdaftar yang bisa diabsen
- [ ] Status kehadiran tersimpan & muncul benar di laporan

## Pendaftaran Anggota Baru
- [ ] Guest bisa submit form tanpa login
- [ ] NIS yang sudah pernah daftar (pending/approved) tidak bisa daftar ulang
- [ ] Approve → otomatis membuat User + Anggota baru dengan status aktif
- [ ] Password awal (NIS + suffix acak) muncul ke Admin hanya sekali saat approve
- [ ] Akun hasil approve wajib ganti password saat login pertama kali
- [ ] Reject → status tersimpan, tidak ada User/Anggota yang terbuat

---

### Contoh Kasus Uji (Pendaftaran Kegiatan)
```text
Kuota = 50, Peserta = 50   → Pendaftaran ditolak
User sudah terdaftar        → Pendaftaran ditolak
Kegiatan dibatalkan         → Pendaftaran ditolak
User tidak aktif            → Pendaftaran ditolak
```

> Business rules yang jadi dasar checklist ini ada di `04-business-flow-dan-rules.md`.
> Jalankan checklist ini penuh di Hari 13 roadmap (`09-roadmap-2-minggu.md`).
