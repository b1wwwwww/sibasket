# 05. Application Architecture & Technology Stack

[← Kembali ke index](./00-README.md)

---

## 5.1 Architecture

```text
                         SIBASKET
                              │
              ┌───────────────┴───────────────┐
              │                               │
         PUBLIC WEBSITE                  ADMIN PANEL
         (Guest & Member)          (Super Admin, Admin, Pembina)
              │                               │
          Livewire                         Filament
              │                               │
              └───────────────┬───────────────┘
                              │
                           Laravel
                              │
                    ┌─────────┴─────────┐
                    │                   │
                 Eloquent             MySQL
```

### Public & Member
**Teknologi:** Blade, Livewire, Tailwind CSS
Digunakan untuk: menampilkan data publik, login member, pendaftaran kegiatan, lihat riwayat sendiri.

### Admin & Pembina
**Teknologi:** Filament, Filament Shield (role/permission), Livewire, Laravel
Digunakan untuk: CRUD data, dashboard, tabel & filter, manajemen permission.

---

## 5.2 Technology Stack

| Bagian | Teknologi |
|---|---|
| Backend | Laravel 11/12 (pakai versi LTS/stable terbaru saat mulai, bukan versi eksperimental) |
| Language | PHP 8.2+ |
| Database | MySQL |
| Public & Member UI | Blade + Livewire |
| Admin/Pembina UI | Filament 3/4 |
| Role & Permission | spatie/laravel-permission + filament-shield |
| CSS | Tailwind CSS |
| Authentication | Laravel Breeze/Fortify (public) + Filament Auth (admin) |
| Version Control | Git + GitHub |
| Deployment | [isi hosting: misal Railway/Niagahoster/shared hosting sekolah] |

> Catatan: pilih versi Laravel & Filament yang **stabil dan sudah rilis resmi** saat
> kamu mulai coding — cek dokumentasi resmi di titik itu, jangan asumsikan dari
> dokumen ini yang dibuat di awal planning.
