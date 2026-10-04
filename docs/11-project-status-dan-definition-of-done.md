# 11. Project Status & Definition of Done

[← Kembali ke index](./00-README.md)

---

## 11.1 Project Status

|| Module | Priority | Status |
||---|---|---|
|| Authentication & Role | High | ✅ |
|| Anggota (CRUD) | High | ✅ |
|| Kegiatan (CRUD) | High | ✅ |
|| Pendaftaran Kegiatan | High | ✅ |
|| Absensi (Input + Recap) | High | ✅ |
|| **Keuangan (dimajukan jadi prioritas)** | **High** | **🟨 WIP** |
|| Pengumuman | Medium | ⬜ |
|| Dashboard Widgets | Medium | ⬜ |
|| Laporan Export (PDF/Excel) | Medium | ⬜ |
|| Pendaftaran Anggota Baru (Form Publik) | Medium | ⬜ |
|| Deployment | High | ⬜ |
|| Galeri (Optional) | Low | ⬜ |
|| QR Absensi (Future) | Future | ⬜ |

> Legenda: ⬜ Belum mulai · 🟨 Sedang dikerjakan · ✅ Selesai

---

## 11.2 Definition of Done

Sebuah fitur MVP dianggap selesai apabila:
- [ ] Database & relationship sudah benar
- [ ] Validasi & business rules (`04-business-flow-dan-rules.md`) sudah berjalan
- [ ] Authorization per role sudah diuji (bukan cuma diasumsikan benar)
- [ ] UI bisa dipakai tanpa error oleh non-developer
- [ ] Edge case di `08-testing-checklist.md` sudah dicek
- [ ] Kamu (developer) bisa menjelaskan cara kerja fitur ini tanpa membaca ulang kode
