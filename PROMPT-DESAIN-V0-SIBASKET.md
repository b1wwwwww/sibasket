# 🏀 SI-BASKET: PROMPT DESIGN UNTUK v0.dev / AI DESIGN GENERATOR

Copy-paste prompt ini langsung ke v0.dev, Claude Artifacts, atau AI design tool lainnya untuk generate design lengkap aplikasi basket.

---

## PROMPT MASTER (COPY LANGSUNG KE v0.dev)

```
Kamu adalah UI/UX designer profesional untuk aplikasi web modern.

Buat design lengkap aplikasi **SI-BASKET** (Sistem Manajemen Organisasi Basket) dengan teknologi React + Next.js + Tailwind CSS.

=== REQUIREMENT DESIGN ===

**Aplikasi:** SI-BASKET - Manajemen Organisasi Basket
**Fitur Utama:** Landing page, public pages (kegiatan, pengumuman), admin dashboard (anggota, kegiatan, absensi, keuangan, pengumuman), export functionality
**Inspirasi:** Gaya Rallyo Club (modern, sporty, clean, minimalist)
**Target User:** Admin, Pembina, Anggota Organisasi Basket
**Device:** Desktop-first, responsive (tablet & mobile)

=== COLOR PALETTE ===
- Navy Blue (Primary): #1F3A5F
- Orange/Coral (Secondary/CTA): #FF6B35
- Light Gray (Background): #F5F5F5
- White (Cards): #FFFFFF
- Dark Gray (Text): #2C3E50
- Green (Success): #27AE60
- Red (Error): #E74C3C

=== TYPOGRAPHY ===
- Font: Inter, Poppins, atau Montserrat (sans-serif)
- Headline: 48px Bold (landing), 32px Bold (page title), 24px Bold (section)
- Body: 16px Regular
- Small: 14px Regular
- Caption: 12px Regular

=== HALAMAN 1: LANDING PAGE (PUBLIC HOME) ===

NAVBAR (Fixed Top):
- Background: Navy semi-transparent dengan blur effect (rgba(31, 58, 95, 0.95))
- Height: 72px
- Komponen: Logo "SI-BASKET" (kiri) | Menu pills (About, Kegiatan, Pengumuman, Tentang Kami) | Search bar | Login button | Hamburger (mobile)
- Styling: White text, rounded pill buttons (active = orange bg), search input dengan ikon, login button navy solid

HERO SECTION:
- Background: Full-width image lapangan basket outdoor dengan pemain (overlay dark 40%)
- Content Container: White rounded card (border-radius: 24px, shadow-2xl, padding 48px) di tengah-bawah
- Dalam container:
  * Carousel foto (3-5 gambar basketball, auto-play 5s, dot indicators)
  * Headline: "Bangun Komunitas, Raih Prestasi" (48px bold navy)
  * Subheadline: "Bergabunglah dengan komunitas basket kami. Latihan rutin, kegiatan menarik, dan kesempatan berkompetisi menanti Anda." (18px gray)
  * Buttons: "Lihat Kegiatan ▶" (orange solid) | "Daftar Sekarang ▶" (navy outline)

RESPONSIVE: Desktop hero 600px, tablet 500px, mobile full-width dengan buttons stack

=== HALAMAN 2: KEGIATAN PUBLIK ===

Layout: Navbar sama | Title "Kegiatan Terbaru" | Grid card kegiatan (3 kolom desktop, 2 tablet, 1 mobile)

Card Kegiatan:
- Foto 4:3 aspect ratio (200px height)
- Badge tanggal (orange pill, 12px)
- Nama kegiatan (18px bold)
- Lokasi (14px gray dengan icon)
- Button "Lihat Detail ▶"
- Hover: Shadow increase, slight scale

Pagination/Load More di bawah

=== HALAMAN 3: DETAIL KEGIATAN ===

- Full-width background image (400px height)
- White card container (border-radius 16px, padding 40px)
- Info grid (2 kolom): Tanggal, Waktu, Lokasi, Kuota
- Deskripsi panjang
- Button "Daftar Kegiatan" (orange, 14px 40px padding)

=== HALAMAN 4: DASHBOARD LAYOUT (UNTUK SEMUA HALAMAN INTERNAL) ===

Sidebar (Fixed Kiri):
- Background: Light gray #F5F5F5
- Width: 200px
- Menu items: Dashboard, Anggota, Kegiatan, Absensi, Keuangan, Pengumuman, Logout
- Active item: Navy bg + white text + orange left border
- Hover: Light blue bg

Navbar Dashboard (Fixed Top):
- Background: Navy
- Height: 64px
- Komponen: Logo | Breadcrumb | Search | User profile dropdown | Notifications

Main Content Area:
- Padding: 24px
- Background: Light gray #F5F5F5

=== HALAMAN 5: DASHBOARD ADMIN (HOME) ===

Header: "Selamat datang, Nabil" + "Admin Dashboard"

4 Metric Cards (Grid 4 kolom, responsive 2 tablet / 1 mobile):
1. Total Anggota - 45 (orange icon, ↑ 3 baru)
2. Kegiatan Aktif - 8 (blue icon, ↑ 2 minggu ini)
3. Tingkat Kehadiran - 82% (green icon, ↑ 5%)
4. Saldo Kas - Rp 5.2jt (purple icon, ↑ Rp 500k)

Card styling: White, shadow, border-top 4px orange, padding 24px

Lower section (2 kolom):
- Kiri (60%): Chart (bar chart atau line chart) "Kehadiran Per Bulan"
- Kanan (40%): Recent Activity list (5 items)

=== HALAMAN 6: TABEL DATA (MANAJEMEN ANGGOTA) ===

Header Section:
- Title: "Manajemen Anggota" (24px bold)
- Button: "➕ Tambah Anggota" (orange solid, kanan)

Filter Bar:
- Search input: "Cari nama atau email..."
- Filter dropdown: "Status: [Semua / Aktif / Nonaktif]"
- Refresh button

Table:
- Header row: Navy background, white text, bold
- Kolom: No | Nama | Email | Peran (badge) | Status (badge) | Aksi (Edit + Delete icons)
- Body rows: White, border-bottom 1px, hover light gray
- Pagination: "Showing 1-10 of 45" + Page buttons (1 2 3)

=== HALAMAN 7: FORM INPUT/EDIT ===

Container:
- White card, border-radius 12px, shadow, max-width 800px, centered
- Padding: 40px

Form Fields (Grid 2 kolom responsive):
- Label (14px bold navy)
- Input field: border 1px #DDD, padding 12px 16px, focus border orange
- Sections: Info Dasar | Detail Lanjutan | Deskripsi

Buttons (Bottom right):
- "Batal" (gray outline)
- "Simpan Kegiatan" (orange solid)

=== HALAMAN 8: EXPORT KEUANGAN ===

Filter Card (light blue bg, border-left 4px orange):
- Jenis Transaksi: [Semua / Pemasukan / Pengeluaran]
- Rentang Tanggal: From date | To date
- Buttons: Reset Filter | Lihat Preview

Preview Table: Standard table styling, max-height 400px

Download Button: Green background atau Navy, icon download, 14px bold

=== RESPONSIVE GUIDELINES ===

Desktop (1200px+):
- Sidebar: 200px fixed
- Metric cards: 4 kolom
- Tables: full width dengan scroll horizontal
- Forms: max-width 800px

Tablet (768px - 1199px):
- Sidebar: Collapsible drawer
- Metric cards: 2 kolom
- Tables: scrollable
- Forms: max-width 600px

Mobile (< 768px):
- Sidebar: Full-screen overlay drawer
- Metric cards: 1 kolom
- Tables: vertical scroll atau card stack
- Forms: full width, padding 16px
- Buttons: full-width

=== INTERACTION & ANIMATION ===

Hover effects:
- Buttons: Scale 1.05, shadow increase
- Cards: Shadow increase, lift slightly
- Rows dalam tabel: Background color change
- Links: Color change orange, underline

Transitions: 0.2s - 0.3s ease-in-out smooth

Focus states:
- Inputs: Border 2px orange, shadow light orange

Modals:
- Overlay: rgba(0, 0, 0, 0.5)
- Dialog: border-radius 12px, shadow-lg, white bg

Loading states:
- Spinner atau skeleton loader

=== TOOLS & LIBRARY REKOMENDASI ===

- React components
- Tailwind CSS untuk styling
- Icons: Lucide React atau Heroicons
- Form: React Hook Form
- Table: TanStack Table (React Table)
- Charts: Recharts atau Chart.js
- Carousel: Swiper.js atau Embla Carousel
- Date picker: React DatePicker atau Day.js

=== OUTPUT YANG DIINGINKAN ===

1. Landing Page (Navbar + Hero + Action buttons) — Halaman pertama yang user lihat
2. Kegiatan Publik & Detail — Browse kegiatan sebelum login
3. Dashboard Admin Layout — Layout base dengan sidebar + navbar
4. Dashboard Home — Cards + Charts
5. Tabel Manajemen Anggota — CRUD interface
6. Form Tambah/Edit Data — Input form
7. Export Page — Download Excel functionality
8. Mobile responsive preview — Semua halaman responsive

Gunakan React + Next.js + Tailwind CSS untuk implementasi.
Pastikan kode clean, reusable components, dan accessible.
Ikuti best practices React & web design modern.

Jika ada ambiguitas, gunakan keputusan desain yang logis dan professional.
```

---

## TIPS PENGGUNAAN

### Di v0.dev:
1. Buka https://v0.dev
2. Click "Create"
3. Paste seluruh prompt di atas ke text area
4. Click "Generate"
5. Tunggu hasilnya
6. Edit/refine sesuai kebutuhan
7. Export ke code atau screenshot

### Di Claude Artifacts:
1. Share prompt ini ke Claude
2. Request: "Generate design system UI dengan prompt ini"
3. Claude akan generate React components
4. Bisa di-edit langsung di artifacts

### Di Figma:
1. Gunakan brief sebagai design spec
2. Create frame untuk setiap halaman
3. Buat components reusable
4. Export ke Figma prototype

---

## ALTERNATIF: PROMPT PER SECTION

Jika ingin generate satu per satu:

### Prompt 1: Landing Page Only
```
Buat landing page modern untuk aplikasi basket "SI-BASKET" dengan:
- Navbar fixed dengan logo, menu pills, search, login button
- Hero section full-width dengan background lapangan basket + carousel foto
- White rounded container dengan headline, subheadline, dan 2 CTA buttons
- Styling: Navy (#1F3A5F), Orange (#FF6B35), White
- Responsive design
- Gunakan React + Tailwind CSS
```

### Prompt 2: Dashboard Only
```
Buat dashboard admin layout dengan:
- Sidebar fixed kiri dengan navigation menu
- Top navbar dengan logo, breadcrumb, user profile
- Main content area dengan responsive grid
- 4 metric cards (anggota, kegiatan, kehadiran, kas)
- Chart + Recent activity section di bawah
- Styling: Navy sidebar, light gray background, white cards
- Responsive: Desktop 4 cards, tablet 2, mobile 1
```

### Prompt 3: Tabel Data Only
```
Buat komponen tabel manajemen data dengan:
- Header section: Title + "Tambah" button (orange)
- Filter bar: Search + Status dropdown
- Tabel responsive dengan 6 kolom: No, Nama, Email, Peran, Status, Aksi
- Action buttons: Edit + Delete (icons)
- Pagination di bawah
- Hover effects pada rows
- Styling per spec SI-BASKET
```

---

## FILE INI SIAP DIGUNAKAN

**Gunakan prompt lengkap di atas langsung untuk generate design UI lengkap aplikasi SI-BASKET**

Semua detail sudah tercakup: fitur, warna, typography, layout, responsive, interaction. Tinggal copy-paste ke tool design favorit Anda!
