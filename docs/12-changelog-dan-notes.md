# 12. Changelog & Notes

[← Kembali ke index](./00-README.md)

---

## 12.1 Changelog

### v0.1 — [Tanggal mulai]
* Initial planning, adaptasi dari template umum ke kebutuhan Eskul Basket.
* Keputusan: Admin pakai 1 role dengan permission granular, bukan role terpisah per jabatan.
* Scope MVP ditentukan untuk target 2 minggu.

### v0.2 — [Tanggal]
* **Scope bertambah:** modul baru **Pendaftaran Anggota Baru** — form publik permanen
  (bukan cuma saat event demo eskul) untuk calon anggota mendaftar gabung eskul,
  menggantikan Google Form yang dipakai tahun-tahun sebelumnya.
* Penamaan "Pendaftaran" lama diganti jadi **Pendaftaran Kegiatan** untuk membedakan
  dari **Pendaftaran Anggota Baru** (lihat `04-business-flow-dan-rules.md` §4.3).
* Keputusan: akun anggota di-generate otomatis saat Admin approve pendaftaran
  (username = NIS, password awal = NIS + suffix acak, wajib ganti password saat
  login pertama).
* Dampak roadmap: menambah 1 hari kerja ke Minggu 2 (`09-roadmap-2-minggu.md`, Hari 8).

---

### v0.3 — 04 Oktober 2026
* **Keputusan strategis: Keuangan dimajukan dari Optional menjadi prioritas utama.**
  - Alasan: Sistem keuangan/kas adalah modul backend kritis untuk operasional eskul. 
    Setelah Absensi selesai, Keuangan harus dikerjakan sebelum Dashboard & Pengumuman.
  - Dampak: Pendaftaran Anggota Baru (form publik) digeser dari MVP Hari 8 ke status 
    Optional/Medium priority, setelah semua modul backend inti selesai.
  - Timeline tetap: Deployment masih target akhir minggu 2, asalkan fokus pada modul 
    inti (Keuangan + Dashboard + Pengumuman). Form Pendaftaran Anggota Baru bisa 
    dikerjakan Minggu 3 jika ada waktu atau di fase maintenance.

---

## 12.2 Notes

> Catat setiap keputusan penting di sini — terutama kalau ada request tambahan dari
> pembina di tengah jalan. Ini jadi bukti kalau ada perubahan scope, bukan salah kamu
> kalau deadline sedikit meleset.

```text
[TANGGAL]
Keputusan:
...

Alasan:
...

Dampak ke scope/timeline:
...
```
