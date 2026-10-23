# Ringkasan Diskusi UX, Navigasi, & Flow SIBASKET

Dokumen ini merekam hasil diskusi terkait struktur navigasi web publik, area member setelah login, flow profile & dashboard, serta spesifikasi UI/UX (Public vs Member).

---

## 1. Struktur Navigasi Web (Navbar)

### A. Tampilan Public (Belum Login / Pengunjung)
Navbar memuat link informasi organisasi, akses autentikasi, dan CTA pendaftaran:
- **Logo SIBASKET** (Mengarah ke Home)
- **Menu Utama:** Home, Tentang Kami, Sejarah & Prestasi, Galeri, Pengumuman, Kegiatan, Kontak
- **Auth & CTA Buttons:**
  - **[Login]** (Tombol sekunder menuju halaman masuk)
  - **[Daftar Sekarang]** (Tombol utama / CTA menuju form pendaftaran anggota baru)

### B. Tampilan Member (Sudah Login)
Navbar berubah menyesuaikan status user, tombol login/daftar hilang dan diganti menu personal:
- **Logo SIBASKET**
- **Menu Utama (tetap bisa diakses):** Home, Tentang, Sejarah, Galeri, Pengumuman, Kegiatan, Kontak
- **Fitur Member:**
  - **🔔 Notifikasi** (Indikator badge untuk update/pengumuman baru)
  - **👤 Profile Dropdown** (Avatar + Nama user dengan menu popover):
    - 📊 **Dashboard** (Akses ke area utama member)
    - 👤 **Profile Saya** (Detail data diri, statistik, dan status)
    - ⚙️ **Pengaturan** (Ubah password, setting akun)
    - 🚪 **Logout** (Keluar sesi)

---

## 2. Struktur Halaman & Area Member

### A. Dashboard Member (`/dashboard`)
Halaman utama yang terbuka setelah login (Personal metrics & quick access):
- **Welcome Banner:** Sapaan personal (contoh: "Halo, Budi Santoso!")
- **Statistik Personal (Widget Cards):**
  - Presentase Kehadiran (contoh: 85%)
  - Total Kegiatan yang diikuti
  - Saldo Kas pribadi
  - Status Tunggakan pembayaran
- **Upcoming Kegiatan:** Jadwal latihan atau turnamen terdekat
- **Pengumuman Terbaru:** Broadcast informasi dari admin

### B. Halaman Profile Saya (`/dashboard/profile`)
Halaman detail informasi member:
- **Informasi Personal:** Foto, Nama, Email, No. Identitas (NIS/KTP), Kelas/Jurusan, No. WhatsApp, Alamat
- **Status Keanggotaan:** Badge Status (Aktif), Tanggal Bergabung
- **Statistik Kehadiran:** Rincian total hadir vs tidak hadir
- **Keuangan & Transaksi:** Info saldo kas, catatan tunggakan, dan link riwayat transaksi
- **Action Buttons:** [Edit Profile] & [Ubah Password]

---

## 3. Rangkaian Flow User (End-to-End)

### Skenario 1: Pengunjung Baru (Belum Login)
1. **Akses:** Buka `sibasket.local` (Landing page publik).
2. **Eksplorasi:** Baca info tentang klub, sejarah turnamen, galeri foto, dan jadwal kegiatan.
3. **Pendaftaran:** Klik tombol **[Daftar Sekarang]** di navbar atau banner utama.
4. **Isi Form:** Mengisi formulir pendaftaran anggota (nama, email, NIS, kelas, no WA, dll).
5. **Submit:** Data masuk ke sistem dengan status `PENDING`.
6. **Success Page:** Muncul pesan sukses beserta **CTA Button WhatsApp Admin** (`wa.me` link).
7. **Verifikasi WhatsApp:** Pengunjung klik tombol WA untuk chat admin, konfirmasi data secara langsung.
8. **Approval Admin:** Admin memverifikasi di WA, lalu klik **[Setujui]** di dashboard admin.
9. **Pembuatan Akun:** Sistem otomatis membuat akun (User & profile Anggota) dan generate password.
10. **Pengiriman Kredensial:** Admin mengirimkan Username & Password via chat WhatsApp ke member.

### Skenario 2: Member yang Sudah Terdaftar & Login
1. **Akses & Login:** Masuk ke `sibasket.local/login`, masukkan kredensial dari admin.
2. **Navbar Aktif:** Navbar menampilkan nama member dan profile dropdown.
3. **Eksplorasi Area Member:**
   - Masuk ke **Dashboard** untuk melihat statistik kehadiran & info kas.
   - Buka **Profile Saya** untuk melihat / memperbarui data diri.
   - Cek **Absensi & Kegiatan** untuk melihat jadwal dan riwayat kehadiran.
   - Baca **Pengumuman** klub.
4. **Logout:** Mengklik menu **Logout** dari dropdown profile untuk mengakhiri sesi.

---

*Dokumen direkam & diperbarui pada: 2026-10-22*
