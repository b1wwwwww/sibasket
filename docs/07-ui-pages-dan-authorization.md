# 07. UI Pages & Authorization Matrix

[← Kembali ke index](./00-README.md)

---

## 7.1 UI Pages

### Public (No Auth)
```text
/
├── Home
├── Tentang Eskul
├── Kegiatan (Jadwal publik)
│   └── Detail Kegiatan
├── Pengumuman (Published only)
│   └── Detail Pengumuman
├── Daftar Jadi Anggota (Form publik, permanen)
└── /auth/login
```

### Authenticated (/dashboard — Role-Based Sidebar)
```text
/dashboard
├── Dashboard (role-specific home)
│
├── [Super Admin & Admin]
│   ├── Anggota (CRUD)
│   ├── Kegiatan (CRUD)
│   ├── Pendaftaran Kegiatan (view per kegiatan)
│   ├── Absensi (input + recap)
│   ├── Keuangan (CRUD transaksi kas)
│   ├── Pengumuman (CRUD)
│   ├── Laporan & Export (kehadiran, keuangan)
│   └── Role & Permission (Super Admin only)
│
├── [Bendahara / Sie Absensi]
│   ├── Keuangan (view + CRUD transaksi)
│   ├── Absensi (view + input)
│   ├── Pengumuman (view)
│   └── Laporan (export)
│
└── [Member]
    ├── Dashboard (personal stats)
    ├── Kegiatan (lihat & daftar)
    ├── Riwayat Absensi (view-only, data pribadi)
    ├── Riwayat Pembayaran Kas (view-only)
    └── Edit Profil
```

> **Catatan Livewire routing:** Semua authenticated pages di bawah `/dashboard`.
> Sidebar menu dinamis berdasarkan role (tidak ada URL prefix `/member`, `/admin`).
> Authorization via Livewire policies & gates di component level.

---

## 7.2 Authorization Matrix

| Fitur | Super Admin | Ketua | Bendahara | Absensi/Sekretaris | Pembina | Member | Guest |
|---|---:|---:|---:|---:|---:|---:|---:|
| Dashboard | ✓ | ✓ | ✓ | ✓ | View | ✓ (personal) | - |
| Anggota | ✓ | ✓ CRUD | ✓ CRUD | ✓ CRUD | View | - | - |
| Pendaftaran Anggota Baru | ✓ | ✓ Approve | - | ✓ Approve | View | - | Submit |
| Kegiatan | ✓ | ✓ CRUD | - | ✓ CRUD | View | View + Daftar | View |
| Pendaftaran Kegiatan | ✓ | ✓ CRUD | - | ✓ CRUD | View | Own only | - |
| Absensi | ✓ | - | - | ✓ CRUD | View | View (own) | - |
| Keuangan | ✓ | - | ✓ CRUD | - | View | - | - |
| Pengumuman | ✓ | ✓ CRUD | ✓ CRUD | ✓ CRUD | View | View | View |
| Laporan & Export | ✓ | ✓ View | ✓ View | ✓ View | View | - | - |
| Role & Permission | ✓ | - | - | - | - | - | - |

> **Catatan khusus Guest:** satu-satunya aksi tulis (write) yang boleh dilakukan Guest
> di seluruh sistem adalah submit form Pendaftaran Anggota Baru. Ini perlu perhatian
> ekstra saat implementasi (validasi input, proteksi dari spam submission — misal
> rate-limit atau captcha sederhana kalau sempat).

> Untuk detail permission lengkap per role, lihat `02-role-dan-akses.md`.
