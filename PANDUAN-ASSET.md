# 📂 Panduan Asset & Foto Dokumentasi SIBASKET (KOMET)

Untuk pengelolaan foto dokumentasi agar rapi, efisien, dan performan:

## 1. Lokasi Penyimpanan (Path)
Simpan semua file publik (foto galeri, foto kegiatan, foto pelatih) di folder berikut:
- **Root:** `/home/nnabiel/All-Project/sibasket/storage/app/public/gallery/`
- **Struktur Folder:**
  ```text
  storage/app/public/gallery/
  ├── tahun/
  │   ├── 2022/
  │   ├── 2023/
  │   └── 2024/
  └── kategori/
      ├── latihan/
      ├── turnamen/
      └── sosial/
  ```

## 2. Format File & Optimasi
Agar website tetap cepat (tidak berat saat load 50+ foto):
- **Format:** Gunakan `.webp` (Sangat disarankan karena ukuran kecil & kualitas tinggi). Jika tidak bisa, gunakan `.jpg` atau `.jpeg` dengan kompresi maksimal.
- **Ukuran:**
  - **Thumbnail:** Max width 400px (untuk galeri grid).
  - **Full Image:** Max width 1920px (untuk lightbox).
- **Tool Kompresi:** Gunakan [TinyJPG](https://tinyjpg.com) atau [Squoosh](https://squoosh.app) sebelum upload ke server.

## 3. Cara Mengakses di Blade
Laravel harus membuat symbolic link agar folder `storage` bisa diakses dari web:
```bash
php artisan storage:link
```
Contoh pemanggilan di Blade:
```blade
<img src="{{ asset('storage/gallery/2024/turnamen/foto-juara.webp') }}" alt="Foto Juara 2024">
```

## 4. Rekomendasi Alur Foto
- **Admin:** Upload foto melalui dashboard admin (`/dashboard/galeri`) yang sudah kita rencanakan.
- **Frontend:** Gunakan `Lazy Loading` di HTML agar halaman tidak berat.
  ```html
  <img src="..." loading="lazy" alt="...">
  ```

## 5. Contoh Asset (untuk placeholder)
Jika kamu belum punya foto asli sekarang, gunakan placeholder dari [Unsplash Source](https://unsplash.com/):
```html
<img src="https://source.unsplash.com/random/800x600?basketball" alt="Basketball">
```
---
Saran saya: Mulai dengan mengumpulkan foto asli (karena foto asli memberikan *trust* lebih tinggi daripada stock photo/AI). Jika foto belum ada, pakai placeholder dulu di awal coding.
