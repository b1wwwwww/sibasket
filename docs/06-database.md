# 06. Database

[← Kembali ke index](./00-README.md)

---

## 6.1 Entity Utama (MVP)
```text
User (akun login, punya role)
Role & Permission (Spatie)
Anggota (profil anggota, terhubung ke User)
Kegiatan
PendaftaranKegiatan (pivot: Anggota <-> Kegiatan)
Absensi (terhubung ke PendaftaranKegiatan atau ke Anggota+Kegiatan)
Pengumuman
PendaftaranAnggota (calon anggota, belum tentu jadi Anggota — modul baru)
```

> **Catatan penamaan:** tabel `pendaftaran` yang tadinya untuk pendaftaran kegiatan
> sekarang disebut `pendaftaran_kegiatan` supaya tidak tertukar dengan tabel baru
> `pendaftaran_anggota` di bawah.

## 6.2 Relationship
```text
User
  │
  ├── Role (via Spatie: model_has_roles)
  └── Anggota (1:1, hanya jika role Member)

Anggota
  │
  ├── PendaftaranKegiatan (1:N)
  └── Absensi (1:N, via PendaftaranKegiatan)

Kegiatan
  │
  ├── PendaftaranKegiatan (1:N)
  └── Absensi (1:N)

PendaftaranKegiatan
  │
  └── Absensi (1:1, opsional — absensi hanya ada jika sudah terdaftar)

PendaftaranAnggota (berdiri sendiri, belum terhubung ke User/Anggota)
  │
  └── saat di-approve → membuat 1 User baru + 1 Anggota baru
```

## 6.3 Rancangan Tabel Inti

### `anggota`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| user_id | bigint FK | Relasi ke tabel users |
| nis / nomor_induk | string | Nomor identitas siswa |
| nama | string | Nama lengkap |
| kelas | string | Kelas saat ini |
| posisi | string, nullable | Posisi di basket (PG/SG/C/dll), opsional |
| status | enum(aktif, nonaktif) | Status keanggotaan |
| tanggal_bergabung | date | |

### `kegiatan`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| judul | string | |
| deskripsi | text | |
| tanggal | datetime | |
| lokasi | string | |
| kuota | integer, nullable | null = tanpa batas kuota |
| status | enum(draft, published, ongoing, completed, cancelled) | |

### `pendaftaran_kegiatan`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| anggota_id | bigint FK | |
| kegiatan_id | bigint FK | |
| status | enum(terdaftar, dibatalkan) | |
| created_at | timestamp | waktu daftar |

### `pendaftaran_anggota` *(modul baru)*
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| nama | string | Nama calon anggota |
| nis | string, unique | Nomor identitas siswa — dicek supaya tidak dobel daftar |
| kelas | string | |
| kontak | string | No. WA / email calon anggota |
| alasan_gabung | text, nullable | |
| status | enum(pending, approved, rejected) | |
| alasan_ditolak | text, nullable | Diisi jika status = rejected |
| anggota_id | bigint FK, nullable | Terisi otomatis setelah approve, relasi ke Anggota yang dibuat |
| created_at | timestamp | waktu submit |

### `absensi`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| pendaftaran_id | bigint FK | |
| status_kehadiran | enum(hadir, izin, sakit, alpa) | |
| catatan | text, nullable | |

### `pengumuman`
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| judul | string | |
| isi | text | |
| tanggal_publish | date | |

> Struktur ini final untuk MVP. Kalau nanti modul Optional (misal Keuangan) dikerjakan,
> tambahkan tabel baru di sini dan catat perubahannya di `12-changelog-dan-notes.md`.
