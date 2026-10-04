# 07. UI Pages & Authorization Matrix

[← Kembali ke index](./00-README.md)

---

## 7.1 UI Pages

### Public
```text
/
├── Home
├── Tentang Eskul
├── Kegiatan
│   └── Detail Kegiatan
├── Pengumuman
│   └── Detail Pengumuman
├── Daftar Jadi Anggota   ← halaman baru, permanen & selalu terbuka
└── Login
```

### Member
```text
/member
├── Dashboard
├── Kegiatan (lihat & daftar)
├── Pendaftaran Saya
├── Riwayat Kehadiran
└── Profil
```

### Admin & Pembina
```text
/admin
├── Dashboard
├── Anggota
├── Pendaftaran Anggota Baru   ← menu baru, review approve/reject calon anggota
├── Kegiatan
├── Pendaftaran Kegiatan
├── Absensi
├── Pengumuman
├── Laporan
└── Role & Permission (khusus Super Admin)
```

---

## 7.2 Authorization Matrix

| Fitur | Super Admin | Admin (sesuai permission) | Pembina | Member | Guest |
|---|---:|---:|---:|---:|---:|
| Dashboard | ✓ | ✓ | View | ✓ (versi member) | - |
| Anggota | ✓ | Sesuai permission | View | - | - |
| Pendaftaran Anggota Baru | ✓ | Sesuai permission (approve/reject) | View | - | Submit (isi form) |
| Kegiatan | ✓ | Sesuai permission | View | View + Daftar | View |
| Pendaftaran Kegiatan | ✓ | Sesuai permission | View | Own only | - |
| Absensi | ✓ | Sesuai permission | View | View (own) | - |
| Pengumuman | ✓ | Sesuai permission | View | View | View |
| Laporan | ✓ | Sesuai permission | View | - | - |
| Role & Permission | ✓ | - | - | - | - |

> **Catatan khusus Guest:** satu-satunya aksi tulis (write) yang boleh dilakukan Guest
> di seluruh sistem adalah submit form Pendaftaran Anggota Baru. Ini perlu perhatian
> ekstra saat implementasi (validasi input, proteksi dari spam submission — misal
> rate-limit atau captcha sederhana kalau sempat).

> Untuk detail permission per jabatan pengurus (ketua, bendahara, sie absensi, dll),
> lihat `02-role-dan-akses.md`.
