# SIBASKET — Dokumentasi Project

> Website Eskul Basket — dokumen ini dipecah per topik biar gampang dibaca,
> di-update, dan dilampirkan sebagian-sebagian ke laporan mingguan pembina.

**Status:** Draft / Planning · **Versi:** 0.1 · **Deadline:** 2 minggu dari tanggal mulai
**Developer:** [Nama kamu] · **Organisasi:** Eskul Basket [Nama Sekolah]

---

## Daftar Dokumen

| # | File | Isi |
|---|------|-----|
| 01 | [`01-overview-dan-problem-statement.md`](./01-overview-dan-problem-statement.md) | Deskripsi produk, tujuan, masalah yang diselesaikan |
| 02 | [`02-role-dan-akses.md`](./02-role-dan-akses.md) | Super Admin, Admin, Pembina, Member — struktur permission |
| 03 | [`03-scope-dan-mvp.md`](./03-scope-dan-mvp.md) | MVP wajib, Optional, Future Features |
| 04 | [`04-business-flow-dan-rules.md`](./04-business-flow-dan-rules.md) | Alur bisnis (pendaftaran, absensi, dst) + aturan validasi |
| 05 | [`05-architecture-dan-techstack.md`](./05-architecture-dan-techstack.md) | Arsitektur Full Livewire & stack teknologi ✅ UPDATED |
| 06 | [`06-database.md`](./06-database.md) | ERD & rancangan tabel |
| 07 | [`07-ui-pages-dan-authorization.md`](./07-ui-pages-dan-authorization.md) | Peta halaman + matriks otorisasi per role |
| 08 | [`08-testing-checklist.md`](./08-testing-checklist.md) | Checklist pengujian MVP |
| 09 | [`09-roadmap-6-minggu.md`](./09-roadmap-6-minggu.md) | Breakdown harian 6 minggu Full Livewire ✅ UPDATED |
| 10 | [`10-weekly-report-template.md`](./10-weekly-report-template.md) | Template laporan mingguan untuk pembina |
| 11 | [`11-project-status-dan-definition-of-done.md`](./11-project-status-dan-definition-of-done.md) | Tracker status modul + kriteria "selesai" |
| 12 | [`12-changelog-dan-notes.md`](./12-changelog-dan-notes.md) | Riwayat perubahan scope & catatan keputusan |
| **13** | [`13-full-livewire-decision.md`](./13-full-livewire-decision.md) | **🆕 Keputusan pivot Full Livewire & analisis** |
| **14** | [`14-full-livewire-skenario.md`](./14-full-livewire-skenario.md) | **🆕 File structure & implementation patterns** |

## Cara Pakai

### Onboarding Baru / Review Keputusan Pivot

1. **Mulai dari sini:** [`13-full-livewire-decision.md`](./13-full-livewire-decision.md)
   - Understand WHY Full Livewire (bukan Filament)
   - Lihat login flow & skenario praktis
   - Lihat keuntungan & tantangan

2. **Technical deep-dive:** [`14-full-livewire-skenario.md`](./14-full-livewire-skenario.md)
   - File structure & folder organization
   - Livewire component patterns (examples)
   - Database triggers & functions
   - Development workflow

3. **Implementation timeline:** [`09-roadmap-6-minggu.md`](./09-roadmap-6-minggu.md)
   - 6 minggu breakdown (Oct 6 - Nov 14)
   - Per-hari tasks & deliverables
   - Prioritas & trade-offs jika ada delay

### Kerja Harian

- **Untuk kerja harian minggu ke minggu:** buka `09-roadmap-6-minggu.md` (sesuai minggu berapa).
- **Untuk tracking progress:** update `11-project-status-dan-definition-of-done.md` tiap selesai task.

### Laporan & Dokumentasi

- **Laporan mingguan ke pembina:** gunakan `10-weekly-report-template.md`
  - Salin template, isi dengan progress minggu ini
  - Lampirkan tabel status (`11-project-status-dan-definition-of-done.md`)
  - Reference deliverables dari roadmap

- **Keputusan & perubahan scope:** catat di `12-changelog-dan-notes.md` supaya ada jejak
  - Jangan update kode diam-diam tanpa dokumentasi
  - Jika scope berubah, update README dan roadmap

### Referensi

- **Business logic & validation rules:** [`04-business-flow-dan-rules.md`](./04-business-flow-dan-rules.md)
- **Role & permissions structure:** [`02-role-dan-akses.md`](./02-role-dan-akses.md)
- **Database schema:** [`06-database.md`](./06-database.md)
- **Architecture & tech stack:** [`05-architecture-dan-techstack.md`](./05-architecture-dan-techstack.md)
- **UI pages & authorization matrix:** [`07-ui-pages-dan-authorization.md`](./07-ui-pages-dan-authorization.md)
- **Testing checklist:** [`08-testing-checklist.md`](./08-testing-checklist.md)

---

## Status Dokumentasi (Per 07 Oktober 2026)

✅ **Updated untuk Full Livewire Pivot:**
- `05-architecture-dan-techstack.md` — Architecture updated
- `09-roadmap-6-minggu.md` — Timeline extended (2 minggu → 6 minggu)
- `13-full-livewire-decision.md` — 🆕 NEW (decision & analysis)
- `14-full-livewire-skenario.md` — 🆕 NEW (implementation guide)
- `00-README.md` — 🆕 Updated index & navigation

⏳ **TODO (Optional, sesuai kebutuhan):**
- `12-changelog-dan-notes.md` — Add Full Livewire pivot entry
- `02-role-dan-akses.md` — Review for Livewire implementation (if any changes)
- `07-ui-pages-dan-authorization.md` — Review for Livewire component structure
