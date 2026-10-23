# Konsep Flow Pendaftaran Anggota SIBASKET (Lengkap dengan Diskusi & Implementasi)

Dokumen ini berisi rancangan alur pendaftaran anggota baru hingga mendapatkan akun akses dashboard, beserta catatan diskusi/tanya jawab dan spesifikasi teknis implementasi.

---

## 1. Transkrip Diskusi & Tanya Jawab

### Pertanyaan 1 (User):
> menurut kamu mending bagaimana ? untuk akses web di publik mah belum login juga bisa kan? jadi login itu untuk member atau untuk yg sudah daftar anggota kan? jadi uurtannya bagaiaman donk flow nyaa?

**Jawaban / Rekomendasi Awal:**
- **Public (tanpa login):** Landing page, info organisasi, form pendaftaran anggota.
- **Login (member + admin):** Dashboard, Absensi, Keuangan, Data Anggota, Profile.
- **Urutan Flow:** User baru (publik) -> Klik "Daftar" -> Isi form & submit -> Masuk ke antrean pending -> Admin approve -> User dapat akun & bisa login.

---

### Pertanyaan 2 (User):
> tadi tuh struktur nya gini kan : 
> 1. daftar anggota baru 
> 2. isi form yg ada sampai submmit 
> 3. nah setelah submit kan langsung masuk ke dashboard admin untuk accept atau reject /tolak menunggu dari pihak admin dan jika di accept apakah langsung ada / di buatkan akun untk si member tersebut? dan cara dia tau akun nya sudah di buat gimana? apakah di kasih tau ke wa atau si yg telah daftar itu ada pemberithaun untuk meng chat atau wa admin yg tertera di sini untuk confirmasi?? 
> 4. nah kira kira apakah di dashboard admin nya butuh untuk membuat menu admin baruu? unutk pendaftaran anggota ini atau si accpet dan tolak ini?
> kira kira menurut kamu flow ini cocok tidak, atau kamu ada saran yg lebih baik untuk flow nyaa?

**Jawaban / Analisis:**
- **Flow sudah sangat bagus dan cocok.**
- **Notifikasi/Pemberitahuan:** 
  - Admin melakukan Accept di dashboard.
  - Sistem otomatis membuat akun (Username dari email, Password auto-generate).
  - Muncul modal/opsi bagi admin untuk langsung mengarahkan ke WhatsApp (`wa.me`) dengan pesan template berisi kredensial login (Username & Password).
- **Menu Admin:** 
  - **Sangat perlu** membuat menu baru di dashboard admin bernama **"Pendaftaran Anggota"** (atau "Verifikasi Anggota") agar terpisah dari data anggota yang sudah aktif/valid.

---

### Pertanyaan 3 (User) — FINAL DECISION:
> bentar itu untuk flow notifikasi watshap itu maksud nya gimana coba jelasin flow nya ke saya

**Jawaban / Flow WhatsApp (Approach Pragmatis):**

User menyarankan approach yang lebih sederhana dan personal:

1. **Saat Pendaftar Submit Form** → Sistem tampilkan success message + **CTA Button WhatsApp** untuk langsung chat dengan admin
2. **Pendaftar Chat Admin Manual** → Verifikasi & tanya-jawab real-time via WhatsApp (lebih personal)
3. **Admin Approve dari Dashboard** → Klik tombol approve, sistem auto-create akun
4. **Admin Share Credential** → Admin kirim username & password via WhatsApp chat yang sudah terbuka

**Keuntungan Approach Ini:**
- ✅ Personal & flexible (bisa tanya-jawab langsung)
- ✅ Verifikasi data lebih baik sebelum membuat akun
- ✅ No 3rd-party API complexity (Twilio/Wablas) — langsung WA manual
- ✅ Admin kontrol penuh kapan credential dikirim
- ✅ Lebih aman & trust-building untuk calon anggota

---

## 2. Flow Final — LENGKAP A-Z

```
════════════════════════════════════════════════════════════════
           FLOW PENDAFTARAN ANGGOTA SIBASKET (FINAL)
════════════════════════════════════════════════════════════════

FASE 1: PENDAFTAR ISI FORM (PUBLIC PAGE)
────────────────────────────────────────────

[User / Calon Anggota]
         ↓
Kunjungi sibasket.local → Halaman HOME
         ↓
   Klik tombol "Daftar Sebagai Anggota"
         ↓
  ┌──────────────────────────────────────┐
  │ FORM PENDAFTARAN ANGGOTA (PUBLIC)    │
  │                                       │
  │ Input yang diperlukan:                │
  │ ☑ Nama Lengkap *                    │
  │ ☑ Email *                           │
  │ ☑ No. Identitas (NIS/KTP) *         │
  │ ☑ Kelas/Jurusan *                   │
  │ ☑ No. WhatsApp *                    │
  │ ☑ Alamat                            │
  │                                       │
  │ [SUBMIT]                             │
  └──────────────────────────────────────┘
         ↓
  Data disimpan ke database:
  
  Table: pendaftaran_anggota
  {
    id: 1,
    nama: "Budi Santoso",
    email: "budi@example.com",
    no_identitas: "3208xxxxxxxx",
    no_whatsapp: "628123456789",
    kelas: "XII TKI",
    alamat: "Jl. Merdeka No. 10",
    status: "PENDING",
    created_at: "2026-10-22 15:04:05",
    updated_at: "2026-10-22 15:04:05",
    approved_by: NULL,
    approved_at: NULL
  }


FASE 2: SUCCESS MESSAGE + CTA WHATSAPP (BROWSER)
────────────────────────────────────────────────

Browser menampilkan:

  ┌──────────────────────────────────────────────┐
  │ ✅ PENDAFTARAN BERHASIL!                    │
  │                                              │
  │ Terima kasih sudah mendaftar, Budi!         │
  │ Data kamu sudah kami terima dengan baik.    │
  │                                              │
  │ 📋 Data yang terdaftar:                    │
  │ • Nama: Budi Santoso                        │
  │ • Email: budi@example.com                   │
  │ • No. Identitas: 3208xxxxxxxx              │
  │                                              │
  │ ─────────────────────────────────────────── │
  │                                              │
  │ 🚀 Langkah Selanjutnya:                    │
  │                                              │
  │ Hubungi admin untuk konfirmasi pendaftaran: │
  │                                              │
  │ ┌──────────────────────────────────────┐   │
  │ │ 📱 Chat WhatsApp Admin               │   │ ← CTA BUTTON
  │ │ (wa.me/628xxx link - langsung chat) │   │
  │ └──────────────────────────────────────┘   │
  │                                              │
  │ 💡 Tips:                                   │
  │ • Cantumkan nama: "Budi Santoso"           │
  │ • Sebutkan email: "budi@example.com"       │
  │ • Admin akan memverifikasi data kamu       │
  │ • Proses biasanya selesai 1-2 hari        │
  │                                              │
  │ Terima kasih! 😊                           │
  └──────────────────────────────────────────────┘

  CTA Button: <a href="https://wa.me/628123456789?text=Halo%20Admin!%20Saya%20Budi%20Santoso%20ingin%20konfirmasi%20pendaftaran%20anggota.%20Email:%20budi@example.com" target="_blank">
               📱 Chat WhatsApp Admin
             </a>

  User klik button WhatsApp
         ↓
  WhatsApp app/web membuka chat dengan admin
         ↓
  User siap mengetik pesan ke admin


FASE 3: VERIFIKASI MANUAL VIA WHATSAPP
──────────────────────────────────────

[Pendaftar - Budi]     [Admin - nabilyusr4@gmail.com]
       ↓                          ↓
  Chat terbuka            Menerima pesan Budi
       ↓                          ↓
Budi: "Halo Admin, saya     Admin: "Halo Budi! 👋
      Budi Santoso ingin     Terima kasih daftar.
      konfirmasi pendaftaran. Sebentar saya cek data kamu..."
      Email: budi@...
      NIS: 3208xxxxx"
                                  ↓
                          Admin verifikasi data:
                          - Cek di database
                          - Cek keabsahan no. identitas
                          - Cek email valid
                                  ↓
                          Admin: "Data kamu sudah benar ya?
                                  Alamat: Jl. Merdeka No. 10?"
       ↓
Budi: "Iya Admin, benar.
       Siap kapan saja."
       
                                  ↓
                          Admin: "Baik, diterima! 
                                  Nanti saya approve di dashboard
                                  dan kirim akun login kamu."
                                  ↓
                          (Percakapan ditutup sementara)


FASE 4: ADMIN APPROVE DI DASHBOARD
───────────────────────────────────

[Admin Dashboard]
       ↓
Menu: "Verifikasi Pendaftaran Anggota"
       ↓
  ┌──────────────────────────────────────┐
  │ DAFTAR PENDAFTARAN (STATUS: PENDING) │
  │                                       │
  │ ┌─ Budi Santoso ───────────────────┐ │
  │ │ Email: budi@example.com          │ │
  │ │ No. Identitas: 3208xxxxxxxx     │ │
  │ │ No. WhatsApp: 628123456789      │ │
  │ │ Kelas: XII TKI                  │ │
  │ │ Alamat: Jl. Merdeka No. 10      │ │
  │ │ Terdaftar: Oct 22, 2026 15:04   │ │
  │ │                                  │ │
  │ │ [❌ Tolak]  [✅ Setujui]         │ │
  │ └──────────────────────────────────┘ │
  │                                       │
  │ ┌─ (Pendaftar lain...) ────────────┐ │
  │ └──────────────────────────────────┘ │
  └──────────────────────────────────────┘
       ↓
  Admin klik [✅ SETUJUI]


FASE 5: SISTEM AUTO-CREATE AKUN (BACKEND)
──────────────────────────────────────────

Backend Laravel (ApprovalController@approve)

Step 1: CREATE USER
  ├─ username: "budi@example.com"
  ├─ email: "budi@example.com"
  ├─ password: Auto-generate (bcrypt)
  │  └─ Generated: "XyZ9@123abc" (plain text, untuk dikirim ke admin)
  └─ role: "member"

Step 2: CREATE ANGGOTA (Member Profile)
  ├─ user_id: [FK ke user]
  ├─ nama: "Budi Santoso"
  ├─ no_identitas: "3208xxxxxxxx"
  ├─ kelas: "XII TKI"
  ├─ alamat: "Jl. Merdeka No. 10"
  ├─ status: "AKTIF"
  ├─ tanggal_bergabung: "2026-10-22"
  └─ saldo_kas: 0 (atau default value)

Step 3: UPDATE PENDAFTARAN_ANGGOTA
  ├─ status: "APPROVED"
  ├─ approved_by: "nabilyusr4@gmail.com"
  └─ approved_at: "2026-10-22 15:10:05"

Step 4: RETURN CREDENTIAL TO ADMIN
  └─ Modal muncul di dashboard:
     "Akun berhasil dibuat!
      Username: budi@example.com
      Password: XyZ9@123abc
      
      [Copy]  [Kirim via WhatsApp]"

✅ Akun berhasil dibuat


FASE 6: ADMIN SHARE CREDENTIAL VIA WHATSAPP
──────────────────────────────────────────

Admin kembali ke chat WhatsApp dengan Budi
       ↓
  Admin: "Budi, pendaftaran kamu ✅ DITERIMA!
          
          Berikut akun login kamu:
          📧 Username: budi@example.com
          🔐 Password: XyZ9@123abc
          
          🔗 Login di: sibasket.local/login
          
          ⚠️ Jaga password dengan baik!
          Ubah password setelah login pertama ya!"
       ↓
  Budi menerima & menyimpan credential


FASE 7: MEMBER LOGIN & AKSES DASHBOARD
──────────────────────────────────────

[Budi]
  ↓
Buka browser → sibasket.local/login
  ↓
  ┌────────────────────────────────┐
  │ LOGIN PAGE                     │
  │                                 │
  │ Username: budi@example.com     │
  │ Password: [••••••••••]         │
  │                                 │
  │ [LOGIN]                        │
  └────────────────────────────────┘
  ↓
✅ Login berhasil
  ↓
  ┌─────────────────────────────────────┐
  │ DASHBOARD MEMBER                    │
  │                                      │
  │ Halo, Budi Santoso! 👋             │
  │ Selamat datang di SIBASKET          │
  │                                      │
  │ Menu yang bisa diakses:             │
  │ • 📋 Daftar Kegiatan               │
  │ • ✅ Absensi Kehadiran             │
  │ • 💰 Info Keuangan (view-only)     │
  │ • 📢 Pengumuman                    │
  │ • 👤 Profile Anggota               │
  │ • ⚙️ Ubah Password                │
  │                                      │
  │ Statistik:                          │
  │ • Kehadiran: --% (data mulai terakum)
  │ • Saldo Kas: Rp 0                  │
  │                                      │
  └─────────────────────────────────────┘
  ↓
Member siap menggunakan dashboard!

════════════════════════════════════════════════════════════════
```

---

## 3. Struktur Database

### Tabel: `pendaftaran_anggota`

```sql
CREATE TABLE pendaftaran_anggota (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    no_identitas VARCHAR(50) NOT NULL UNIQUE,
    no_whatsapp VARCHAR(15) NOT NULL,
    kelas VARCHAR(100),
    alamat TEXT,
    status ENUM('PENDING', 'APPROVED', 'REJECTED') DEFAULT 'PENDING',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    approved_by VARCHAR(255) NULLABLE,
    approved_at TIMESTAMP NULLABLE,
    rejection_reason TEXT NULLABLE,
    rejected_at TIMESTAMP NULLABLE,
    
    KEY idx_status (status),
    KEY idx_email (email),
    KEY idx_created_at (created_at)
);
```

### Update Tabel: `users` & `anggota`

Tidak perlu perubahan struktur — tinggal tambah constraint untuk tracking:

```sql
-- Users table (existing)
-- Tambah kolom opsional untuk tracking registrasi:
ALTER TABLE users ADD COLUMN created_from_pendaftaran_anggota_id BIGINT NULLABLE;
ALTER TABLE users ADD FOREIGN KEY (created_from_pendaftaran_anggota_id) REFERENCES pendaftaran_anggota(id);

-- Anggota table (existing)
-- Sudah cukup dengan user_id FK
```

---

## 4. Komponen Teknis yang Perlu Dibangun

### A. Migrations
- [ ] `2026_10_22_create_pendaftaran_anggota_table.php` — Buat tabel pendaftaran

### B. Models
- [ ] `app/Models/PendaftaranAnggota.php` — Model untuk tabel pendaftaran
- [ ] Update `app/Models/User.php` — Tambah relasi ke PendaftaranAnggota

### C. Livewire Components (Admin Dashboard)
- [ ] `app/Livewire/PendaftaranAnggotaTable.php` — Tampilkan list pending (tabel + filter)
- [ ] `app/Livewire/PendaftaranAnggotaApprovalModal.php` — Modal approve/reject + credential display

### D. Controllers
- [ ] `app/Http/Controllers/PendaftaranAnggotaController.php` — Handle form submit & approval logic
- [ ] Update `app/Http/Controllers/DashboardController.php` — Tambah route ke menu pendaftaran

### E. Routes
```php
// Public routes (tanpa auth)
Route::post('/pendaftaran-anggota', [PendaftaranAnggotaController::class, 'store'])->name('pendaftaran-anggota.store');
Route::get('/pendaftaran-anggota', [PendaftaranAnggotaController::class, 'create'])->name('pendaftaran-anggota.create');

// Admin dashboard routes (auth + admin)
Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {
    Route::get('/dashboard/pendaftaran-anggota', [PendaftaranAnggotaController::class, 'index'])->name('dashboard.pendaftaran-anggota.index');
    Route::post('/dashboard/pendaftaran-anggota/{id}/approve', [PendaftaranAnggotaController::class, 'approve'])->name('dashboard.pendaftaran-anggota.approve');
    Route::post('/dashboard/pendaftaran-anggota/{id}/reject', [PendaftaranAnggotaController::class, 'reject'])->name('dashboard.pendaftaran-anggota.reject');
});
```

### F. Views
- [ ] `resources/views/pages/pendaftaran-anggota.blade.php` — Public form
- [ ] `resources/views/pages/pendaftaran-success.blade.php` — Success message + WA CTA
- [ ] `resources/views/livewire/pendaftaran-anggota-table.blade.php` — Admin list
- [ ] `resources/views/livewire/pendaftaran-anggota-approval-modal.blade.php` — Modal approve/credential

### G. Configuration
- [ ] `.env` — Tambah `ADMIN_WHATSAPP_NUMBER=628123456789`
- [ ] Update `config/app.php` jika perlu

---

## 5. Implementasi Checklist

```
PHASE 1: DATABASE & MODEL
- [ ] Create migration `pendaftaran_anggota` table
- [ ] Create PendaftaranAnggota model
- [ ] Update User model (add relationship)
- [ ] Test migration: php artisan migrate

PHASE 2: PUBLIC FORM
- [ ] Create PendaftaranAnggotaController (store method)
- [ ] Create public form view (resources/views/pages/pendaftaran-anggota.blade.php)
- [ ] Create success message view (with WA CTA button)
- [ ] Create routes (POST /pendaftaran-anggota, GET /pendaftaran-anggota)
- [ ] Test: Submit form dan lihat success message
- [ ] Test: Verifikasi data masuk ke database

PHASE 3: ADMIN DASHBOARD
- [ ] Create Livewire component: PendaftaranAnggotaTable.php
- [ ] Create Livewire component: PendaftaranAnggotaApprovalModal.php
- [ ] Create admin routes (GET /dashboard/pendaftaran-anggota)
- [ ] Add menu item di sidebar "Verifikasi Pendaftaran"
- [ ] Test: Tampilkan list pending di admin

PHASE 4: APPROVAL LOGIC
- [ ] Create approval method dalam controller (approve + auto-create user+anggota)
- [ ] Create rejection method
- [ ] Generate password secara aman
- [ ] Return credential modal untuk admin
- [ ] Update pendaftaran_anggota status
- [ ] Test: Approve & lihat akun user+anggota tercipta di database

PHASE 5: CONFIG & FINAL
- [ ] Setup ADMIN_WHATSAPP_NUMBER di .env
- [ ] Setup WA CTA link di success view
- [ ] Tambah permission untuk menu (spatie/permission)
- [ ] Full integration test (end-to-end)
- [ ] npm run build
```

---

## 6. Catatan Teknis

### Password Generation
```php
// Safe password generation
$password = Str::password(length: 12, symbols: true);
// Contoh output: "xY9@Kq2mP!Lv"
```

### WhatsApp CTA Link Format
```php
$adminWA = env('ADMIN_WHATSAPP_NUMBER'); // Format: 628123456789 (dengan kode negara)
$message = "Halo Admin! Saya {$nama} ingin konfirmasi pendaftaran. Email: {$email}";
$waLink = "https://wa.me/{$adminWA}?text=" . urlencode($message);

// Output: https://wa.me/628123456789?text=Halo%20Admin!%20Saya%20...
```

### Status Flow
```
PENDING ──[Admin Approve]──> APPROVED ──[Create User/Anggota]──> ACTIVE LOGIN
   │
   └─[Admin Reject]──> REJECTED
```

### Permissions (Spatie)
```php
// Admin hanya bisa access menu ini
'permission:view-pendaftaran-anggota'
'permission:approve-pendaftaran-anggota'
'permission:reject-pendaftaran-anggota'
```

---

## 7. Timeline Implementasi

| Fase | Komponen | Durasi | Status |
|------|----------|--------|--------|
| 1 | Migration + Model | 30 min | - |
| 2 | Public Form + Success Page | 1 jam | - |
| 3 | Admin Livewire + Routes | 1 jam | - |
| 4 | Approval Logic | 1 jam | - |
| 5 | Testing & Polish | 1 jam | - |
| **Total** | | **4-5 jam** | **Minggu 6+** |

---

*Dokumen diperbarui pada: 2026-10-22 — Final Flow (dengan WhatsApp Manual Verification)*
