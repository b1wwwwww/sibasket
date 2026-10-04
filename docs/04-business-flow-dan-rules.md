# 04. Business Flow & Business Rules

[← Kembali ke index](./00-README.md)

---

## 4.1 Core Business Flow

### Pembuatan Kegiatan
```text
Admin (dengan permission manage-kegiatan)
   ↓
Membuat kegiatan (latihan/pertandingan/seleksi)
   ↓
Isi: nama, deskripsi, tanggal, lokasi, kuota (jika perlu)
   ↓
Set status: Draft atau langsung Published
   ↓
Jika Published → tampil di halaman publik & terlihat oleh Member
```

### Pendaftaran Kegiatan
```text
Member
   ↓
Melihat kegiatan yang published
   ↓
Klik "Daftar"
   ↓
Sistem validasi:
   ├── Sudah terdaftar di kegiatan ini? → jika ya, tolak
   ├── Kegiatan masih menerima pendaftaran (belum ongoing/completed/cancelled)? → jika tidak, tolak
   ├── Kuota masih tersedia (jika kegiatan pakai kuota)? → jika penuh, tolak
   └── Anggota berstatus aktif? → jika tidak aktif, tolak
          ↓
     Pendaftaran berhasil, status: Terdaftar
```

### Absensi
```text
Kegiatan berlangsung (status: Ongoing)
        ↓
Admin (permission manage-absensi) membuka daftar peserta terdaftar
        ↓
Mencatat kehadiran per anggota: Hadir / Izin / Sakit / Alpa
        ↓
Data tersimpan, terhubung ke anggota & kegiatan
        ↓
Otomatis masuk ke rekap Laporan
```

### Pembatalan Kegiatan
```text
Admin membatalkan kegiatan
   ↓
Status → Cancelled
   ↓
Pendaftaran baru ditolak otomatis
   ↓
Anggota yang sudah terdaftar melihat status "Kegiatan Dibatalkan"
```

---

## 4.3 Pendaftaran Anggota Baru (Modul Baru)

> Modul ini **berbeda** dari "Pendaftaran Kegiatan" di atas. Kalau Pendaftaran Kegiatan
> itu anggota yang *sudah jadi member* daftar ikut suatu latihan/pertandingan, modul ini
> untuk orang yang *belum jadi anggota* daftar supaya bisa gabung eskul — menggantikan
> Google Form yang dipakai tahun-tahun sebelumnya.

### Karakteristik Utama
* Halaman pendaftaran **permanen dan selalu terbuka** di website publik (bukan cuma
  muncul saat event demo eskul tahunan).
* Kalau ada event demo eskul, event itu cukup diumumkan lewat modul **Kegiatan** atau
  **Pengumuman** yang sudah ada — link pendaftarannya tetap mengarah ke halaman yang sama.
* Bisa diisi oleh siapa saja tanpa login (guest), karena calon anggota memang belum
  punya akun.

### Flow: Pengajuan Pendaftaran
```text
Calon Anggota (guest, belum login)
   ↓
Buka halaman "Daftar Jadi Anggota" (selalu terbuka)
   ↓
Isi form: nama, kelas, NIS, kontak (WA/email), alasan gabung, dll
   ↓
Submit
   ↓
Sistem validasi: NIS belum pernah dipakai sebelumnya? → jika sudah pernah, tolak
   ↓
Tersimpan dengan status: Pending
```

### Flow: Review oleh Admin (Approve/Reject)
```text
Admin (permission manage-anggota) membuka daftar Pendaftaran Anggota Baru
   ↓
Meninjau data calon anggota
   ↓
   ├── APPROVE
   │      ↓
   │   Sistem otomatis:
   │      ├── Buat User baru → username = NIS
   │      ├── Password awal = NIS + suffix acak (bukan NIS polos)
   │      ├── Buat data Anggota baru → status: aktif
   │      └── Set flag force_password_change = true
   │      ↓
   │   Password awal ditampilkan ke Admin SATU KALI (di layar konfirmasi)
   │      ↓
   │   Admin sampaikan info login ke calon anggota secara manual (WA/langsung —
   │   belum ada modul notifikasi/email otomatis di MVP)
   │      ↓
   │   Anggota login pertama kali → WAJIB ganti password sebelum lanjut
   │
   └── REJECT
          ↓
       Status → Ditolak, alasan penolakan dicatat (opsional, untuk histori)
```

---

## 4.2 Business Rules

### Kegiatan
* Status kegiatan: `draft`, `published`, `ongoing`, `completed`, `cancelled`.
* Kegiatan `completed` atau `cancelled` tidak dapat menerima pendaftaran baru.
* Hanya kegiatan `published` yang tampil di halaman publik.

### Pendaftaran Kegiatan
* Satu anggota tidak dapat mendaftar kegiatan yang sama lebih dari satu kali (unique constraint: `anggota_id` + `kegiatan_id`).
* Pendaftaran ditolak jika kuota penuh (jika kegiatan menetapkan kuota).
* Pendaftaran hanya berlaku untuk anggota berstatus aktif.

### Pendaftaran Anggota Baru
* Halaman form selalu terbuka untuk publik (guest), tidak terikat status event apa pun.
* NIS yang sudah pernah didaftarkan (baik masih Pending, sudah Approved, maupun sudah
  jadi Anggota) tidak boleh didaftarkan ulang.
* Saat di-approve, sistem otomatis membuat akun (username = NIS, password awal =
  NIS + suffix acak) dan data Anggota dengan status aktif.
* Akun hasil approve wajib ganti password saat login pertama kali
  (`force_password_change = true`).
* Password awal hanya ditampilkan satu kali ke Admin saat approve — tidak disimpan
  dalam bentuk plain text setelahnya.

### Anggota
* Hanya anggota berstatus **aktif** yang dapat login dan mendaftar kegiatan.
* Anggota nonaktif tetap tersimpan datanya (histori), hanya dibatasi aksesnya.
* Anggota bisa berasal dari 2 sumber: (a) di-input manual oleh Admin, atau
  (b) hasil approve dari Pendaftaran Anggota Baru.

### Absensi
* Hanya anggota yang terdaftar (status: Terdaftar) pada suatu kegiatan yang bisa memiliki data kehadiran untuk kegiatan itu.
* Satu anggota hanya punya satu data kehadiran per kegiatan (tidak boleh dobel input).

### Permission (Admin)
* Admin hanya bisa mengakses menu sesuai permission yang di-assign Super Admin.
* Super Admin adalah satu-satunya yang bisa mengubah permission Admin lain.

> Rule ini yang harus jadi dasar unit test / manual test kamu — lihat `08-testing-checklist.md`.
