# Testing Guide: Auto-Generate Kegiatan Rutin

**Tanggal Test:** 4 Nov 2026
**Feature:** Auto-generate kegiatan latihan rutin dari JadwalLatihan template

---

## ✅ Backend Verification (SUDAH SELESAI)

### Step 1: JadwalLatihan Aktif
```
✅ 3 jadwal aktif ditemukan:
   - Selasa 15:00 di Lapangan Sekolah
   - Jumat 15:00 di GOR
   - Sabtu 07:00 di Lapangan Sekolah
```

### Step 2: Job Execution
```
✅ Job GenerateJadwalRutinJob berhasil di-trigger
```

### Step 3: Kegiatan Ter-Generate
```
✅ 3 kegiatan baru dibuat untuk minggu depan (11-15 Nov 2026):
   - Latihan Rutin - Selasa (11 Nov)
   - Latihan Rutin - Jumat (14 Nov)
   - Latihan Rutin - Sabtu (15 Nov)
   - Status: published
   - Pendaftar: 9 anggota aktif (auto-registered)
```

### Step 4: Kas Otomatis
```
✅ KasKegiatan: 3 record dibuat (Target Rp 0 dulu, nanti update setelah absensi)
✅ KasAnggota: 27 record dibuat (9 anggota x 3 kegiatan)
   - Status: belum_bayar
   - Nominal: Rp 5.000 per orang per kegiatan
```

### Step 5: Member Data
```
✅ Member@sibasket.test sudah ter-daftar ke 3 kegiatan baru
✅ Tagihan kas: 3 x Rp 5.000 = Rp 15.000 (belum_bayar)
```

---

## 📋 Frontend Testing Checklist (LAKUKAN INI)

### A. Testing sebagai ADMIN

**Login:** nabilyusr4@gmail.com

1. **Halaman Kegiatan (Admin):**
   ```
   URL: http://127.0.0.1:8000/dashboard/kegiatan
   
   Cek:
   [ ] Apakah 3 kegiatan baru muncul?
       - Latihan Rutin - Selasa (11 Nov)
       - Latihan Rutin - Jumat (14 Nov)
       - Latihan Rutin - Sabtu (15 Nov)
   [ ] Badge kategori: "Latihan"
   [ ] Status: "Published"
   [ ] Apakah admin bisa EDIT kegiatan ini? (misal ubah jam, lokasi, atau batalkan)
   [ ] Apakah admin bisa DELETE kegiatan ini kalau mau cancel latihan?
   ```

2. **Halaman Keuangan (Admin):**
   ```
   URL: http://127.0.0.1:8000/dashboard/keuangan
   
   Cek:
   [ ] Dropdown kegiatan: Apakah 3 kegiatan baru muncul di dropdown?
   [ ] Pilih "Latihan Rutin - Selasa"
   [ ] Apakah list 9 anggota muncul dengan status "Belum Bayar"?
   [ ] Toggle checkbox → "Sudah Bayar" untuk 1-2 anggota (test)
   [ ] Refresh page → apakah toggle tersimpan?
   ```

3. **Halaman Absensi (Admin):**
   ```
   URL: http://127.0.0.1:8000/dashboard/absensi
   
   Cek:
   [ ] Dropdown kegiatan: Apakah 3 kegiatan baru muncul?
   [ ] Pilih "Latihan Rutin - Selasa"
   [ ] Apakah list 9 anggota muncul?
   [ ] Bulk action "Hadir Semua" → klik
   [ ] Apakah semua status berubah jadi "Hadir"?
   ```

---

### B. Testing sebagai MEMBER

**Login:** member@sibasket.test

1. **Dashboard Member:**
   ```
   URL: http://127.0.0.1:8000/dashboard
   
   Cek:
   [ ] Card "Jadwal Minggu Ini" → Apakah ada 3 kegiatan?
   [ ] Tanggal: 11 Nov (Selasa), 14 Nov (Jumat), 15 Nov (Sabtu)
   [ ] Status: "Terdaftar" (badge biru)
   ```

2. **Kegiatan Saya:**
   ```
   URL: http://127.0.0.1:8000/dashboard/kegiatan-saya
   
   Cek:
   [ ] Tab "Akan Datang" → Apakah 3 kegiatan muncul?
   [ ] Klik tombol "Deklarasi Status Kehadiran" untuk Latihan Selasa
   [ ] Pilih "Hadir" → Simpan
   [ ] Apakah status berubah jadi badge hijau "Hadir"?
   [ ] Refresh browser (Ctrl+F5) → Apakah masih hijau?
   
   [ ] Klik "Ubah" pada kegiatan yang sudah dideklarasi
   [ ] Ubah ke "Sakit" + isi alasan "Demam"
   [ ] Simpan → Apakah berubah jadi badge kuning "Sakit"?
   ```

3. **Riwayat Pembayaran:**
   ```
   URL: http://127.0.0.1:8000/dashboard/riwayat-pembayaran
   
   Cek:
   [ ] Apakah 3 tagihan kas muncul?
       - Latihan Rutin - Selasa: Rp 5.000 (Belum Lunas)
       - Latihan Rutin - Jumat: Rp 5.000 (Belum Lunas)
       - Latihan Rutin - Sabtu: Rp 5.000 (Belum Lunas)
   [ ] Total Belum Lunas: Rp 15.000
   ```

4. **Riwayat Absensi:**
   ```
   URL: http://127.0.0.1:8000/dashboard/riwayat-absensi
   
   Cek:
   [ ] Apakah kegiatan yang sudah dideklarasi muncul?
   [ ] Status kehadiran sesuai dengan yang dideklarasi?
   ```

---

### C. Testing ADMIN → MEMBER Sync (Real-time)

**Buka 2 tab browser:**
- Tab 1: Login sebagai Admin
- Tab 2: Login sebagai Member

**Test Flow:**
1. **Admin** → Buka Absensi → Pilih "Latihan Rutin - Jumat"
2. **Admin** → Mark semua sebagai "Hadir" (bulk action)
3. **Member** → Tab Riwayat Absensi → Tunggu 30 detik (polling)
4. **Cek:** Apakah status "Hadir" muncul di member tanpa refresh manual?

**Test Flow 2:**
1. **Admin** → Buka Keuangan → Pilih "Latihan Rutin - Sabtu"
2. **Admin** → Toggle 3 anggota → "Sudah Bayar"
3. **Member** → Tab Riwayat Pembayaran → Tunggu 30 detik
4. **Cek:** Apakah status "Lunas" muncul di member?

---

## 🔄 Testing Scheduler (Optional — Production Only)

### Manual Trigger Job (Development)
```bash
cd /home/nnabiel/All-Project/sibasket
php artisan tinker

# Dalam tinker:
App\Jobs\GenerateJadwalRutinJob::dispatch();
```

### Verify Scheduler Config
```bash
php artisan schedule:list
```

Output harus menunjukkan:
```
0 23 * * 0 .... App\Jobs\GenerateJadwalRutinJob .... Weekly on Sunday at 23:59
```

### Run Scheduler (Production)
Di server production, jalankan cron:
```bash
* * * * * cd /path/to/sibasket && php artisan schedule:run >> /dev/null 2>&1
```

---

## 🐛 Troubleshooting

### Kegiatan tidak muncul di member dashboard?
1. Clear cache: `php artisan cache:clear && php artisan view:clear`
2. Hard refresh browser: Ctrl+F5 (atau Cmd+Shift+R di Mac)
3. Cek Livewire polling: Buka Network tab, cari request `livewire/update`

### Kas tidak muncul?
1. Cek Observer: `KegiatanObserver` dan `PendaftaranKegiatanObserver` harus aktif
2. Verify: `php artisan tinker` → `App\Models\KasKegiatan::count()`
3. Re-run seeder jika perlu: `php artisan db:seed --class=KasKegiatanSeeder`

### Absensi tidak sync real-time?
1. Tunggu 30 detik penuh (polling interval)
2. Cek browser console: Tidak boleh ada error JavaScript
3. Verify Livewire: `wire:poll.30s` ada di Blade view

---

## ✅ Hasil Testing (ISI SETELAH SELESAI)

| Test Case | Status | Notes |
|-----------|--------|-------|
| Admin: Kegiatan baru muncul | ⏳ | |
| Admin: Bisa edit kegiatan | ⏳ | |
| Admin: Kas dropdown populated | ⏳ | |
| Admin: Absensi bulk action works | ⏳ | |
| Member: Dashboard kegiatan muncul | ⏳ | |
| Member: Deklarasi status works | ⏳ | |
| Member: Riwayat pembayaran muncul | ⏳ | |
| Member: Riwayat absensi muncul | ⏳ | |
| Real-time sync (30s polling) | ⏳ | |

**Legend:**
- ⏳ Belum test
- ✅ Pass
- ❌ Fail (catat error)

---

**Last Updated:** 4 Nov 2026, 13:49 WIB
