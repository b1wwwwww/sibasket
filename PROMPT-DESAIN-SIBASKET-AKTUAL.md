# 🏀 SI-BASKET: MASTER PROMPT DESAIN WEBSITE PUBLIK (KOMET)

**Copy-paste seluruh prompt lengkap ini ke v0.dev, Claude Artifacts, atau Google AI Studio untuk generate design website KOMET yang lengkap, detail, dan bebas AI-slop.**

---

## STRUKTUR FILE

1. **[MODULAR PROMPTS]** — Untuk generate per bagian halaman (Landing Page)
2. **[MASTER PROMPT LENGKAP]** — Copy ke v0.dev untuk full landing page
3. **[HALAMAN TERPISAH - GUEST]** — Login & Daftar (page berbeda dari landing)
4. **[HALAMAN MEMBER - AFTER LOGIN]** — Profile Member & Member Dashboard
5. **[HALAMAN PUBLIK]** — Gallery Dokumentasi (bisa public atau member-only)

---

## I. MODULAR PROMPTS (Generate Per Bagian)

Gunakan ini untuk validasi atau generate satu section terlebih dahulu.

### 1️⃣ NAVBAR & HERO SECTION

**Prompt:**
```
Buat Navbar & Hero Section untuk "KOMET Basketball Club" (ekstrakurikuler basket).

=== NAVBAR ===
- Background: Navy (#1F3A5F) dengan backdrop blur effect (rgba(31, 58, 95, 0.95))
- Height: 72px
- Logo KOMET (kiri, white text 20px bold)
- Menu Center (pills style):
  * Home (active = orange bg #FF6B35 + white text)
  * About (white text, hover = light orange)
  * Timeline (white text, hover = light orange)
  * Kegiatan (white text, hover = light orange)
- Buttons Kanan:
  * "Daftar Sekarang" (orange solid #FF6B35, 14px bold)
  * "Login" (navy outline, white text, 14px)
- Responsive: Hamburger menu di mobile
- Hover effects: Scale 1.05, smooth 0.3s transition

=== HERO SECTION ===
- Full-width background: Lapangan basket outdoor dengan dark overlay (40% opacity)
- Height: 600px desktop, 400px tablet, 300px mobile
- Content centered:
  * Headline: "KOMET: Lebih Dari Sekadar Tim, Kita Adalah Keluarga" (48px bold white)
  * Subheadline: "Mencetak atlet berprestasi dan membangun karakter melalui basket" (18px light gray)
  * 2 Buttons (horizontal desktop, stacked mobile):
    - "Lihat Perjalanan Kami ▶" (orange solid, 16px bold, padding 14px 28px)
    - "Gabung Sekarang ▶" (white outline, 16px, padding 14px 28px)
- Button hover: Scale 1.05, shadow increase

=== STYLING ===
- Font: Inter, Poppins (sans-serif)
- Border-radius: 8px untuk buttons
- Transition: 0.3s ease-in-out semua hover effects
```

### 2️⃣ ABOUT KOMET SECTION

**Prompt:**
```
Buat section "Tentang Kami - KOMET" dengan desain grid 2 kolom.

=== LEFT COLUMN (40%) ===
- Image placeholder: Foto tim basket (aspect 4:3, height 300px)
- Border-radius: 16px
- Shadow: shadow-lg
- Border: 4px solid orange (#FF6B35)

=== RIGHT COLUMN (60%) ===
- Heading: "Siapa Itu KOMET?" (32px bold navy #1F3A5F)
- Deskripsi: "KOMET adalah ekstrakurikuler basket kami yang fokus pada pengembangan potensi atlet, karakter, dan kerjasama tim. Dengan pelatih berpengalaman dan program latihan terstruktur, kami mempersiapkan generasi atlet berbakat yang tidak hanya handal di lapangan, tapi juga berakhlak mulia." (16px gray, line-height 1.6)
- Stats Grid (3 kolom):
  * Card 1: Angka besar "50+" (24px bold orange) + "Anggota Aktif" (14px gray)
  * Card 2: Angka besar "10+" (24px bold orange) + "Pelatih Berpengalaman" (14px gray)
  * Card 3: Angka besar "3x" (24px bold orange) + "Latihan Per Minggu" (14px gray)

=== CARD STYLING ===
- Background: white
- Padding: 20px
- Border: 1px #EEE
- Border-radius: 12px
- Shadow: shadow-sm
- Responsive: Stack vertikal di mobile, tetap grid di desktop

=== SPACING ===
- Container padding: 60px horizontal, 40px vertical
- Section margin-bottom: 60px
```

### 3️⃣ ACHIEVEMENT TIMELINE SECTION

**Prompt:**
```
Buat "Prestasi KOMET - Timeline Vertical" dengan desain yang professional dan sporty.

=== TIMELINE STRUCTURE ===
- Garis vertikal navy (#1F3A5F), ketebalan 3px, di tengah
- Setiap tahun memiliki:
  * Tahun (24px bold navy, kiri garis)
  * Event title (18px bold navy)
  * Deskripsi (14px gray)
  * Icon medali (orange, kanan garis)
  * Placeholder foto (kecil, 150x150px, di sebelah)

=== DATA TIMELINE ===
1. **2022:** "Juara 1 Walikota Cup Basketball"
   - Deskripsi: "Pertama kalinya KOMET meraih juara di tingkat kota dengan performa sempurna"
   - Icon: Gold medal
   - Foto: placeholder team photo

2. **2023:** "Runner Up Liga Pelajar Nasional"
   - Deskripsi: "Maju ke final nasional dan meraih perak di kompetisi antar sekolah se-Indonesia"
   - Icon: Silver medal
   - Foto: placeholder team photo

3. **2024:** "Top 4 Regional Championship"
   - Deskripsi: "Kompetitif di level regional dengan hasil yang memuaskan"
   - Icon: Bronze medal
   - Foto: placeholder team photo

=== STYLING ===
- Background: Light gray (#F5F5F5) untuk section
- Card background: White
- Padding card: 24px
- Border-left: 4px orange untuk setiap card
- Font timeline heading: Inter bold
- Responsive: Garis vertikal berubah jadi horizontal line di mobile

=== ALIGNMENT ===
- Desktop: Alternate left-right untuk visual menarik
- Tablet: Semua di tengah
- Mobile: Single column, garis di kiri
```

### 4️⃣ KEGIATAN & PENGUMUMAN SECTION

**Prompt:**
```
Buat "Info Terkini" section dengan grid 2 kolom equal width.

=== LEFT COLUMN: KEGIATAN MENDATANG ===
- Heading: "Kegiatan Mendatang" (24px bold navy)
- Cards (stack vertikal):
  * Card 1 - "Latihan Rutin Senin"
    - Icon: Calendar
    - Tanggal: "Setiap Senin 15:30" (14px gray)
    - Lokasi: "Lapangan Indoor" (14px gray)
    - Badge: "Terbuka" (green pill, 12px)
  * Card 2 - "Pertandingan Antar Sekolah"
    - Icon: Trophy
    - Tanggal: "28 Oktober 2026" (14px gray)
    - Lokasi: "Lapangan Kota" (14px gray)
    - Badge: "Mendatang" (orange pill, 12px)
- Card styling: White bg, border-top 4px orange, padding 20px, shadow-sm

=== RIGHT COLUMN: PENGUMUMAN PENTING ===
- Heading: "Pengumuman Terbaru" (24px bold navy)
- News items (stack vertikal):
  * Item 1 - "Pendaftaran Anggota Baru Dibuka"
    - Date: "22 Oktober 2026" (12px gray)
    - Snippet: "Pendaftaran anggota baru KOMET telah dibuka. Daftar sekarang dan jadilah bagian dari keluarga besar kami..." (14px gray)
    - Button: "Baca Selengkapnya ▶" (12px orange text, hover underline)
  * Item 2 - "Jadwal Libur Latihan"
    - Date: "20 Oktober 2026" (12px gray)
    - Snippet: "Latihan ditunda selama seminggu karena event sekolah. Siap kembali berlatih minggu depan..." (14px gray)
    - Button: "Baca Selengkapnya ▶"
- News card styling: White bg, border-left 4px orange, padding 16px, shadow-sm

=== SPACING ===
- Gap antar kolom: 32px
- Gap antar card: 16px
- Container padding: 60px horizontal, 40px vertical

=== RESPONSIVE ===
- Desktop: 2 kolom grid
- Tablet: Stack 1 kolom (kegiatan di atas, pengumuman di bawah)
- Mobile: Full-width stack
```

### 5️⃣ CTA FOOTER & FOOTER SECTION

**Prompt:**
```
Buat section akhir halaman dengan CTA banner dan footer utama.

=== CTA BANNER (HANYA UNTUK GUEST) ===
- Background: Orange gradient (#FF6B35 → #FF8C5A)
- Height: 200px desktop, 150px mobile
- Content centered:
  * Heading: "Siap Menjadi Bagian dari Sejarah KOMET?" (32px bold white)
  * Subheading: "Daftar sekarang dan bergabunglah dengan ribuan atlet berbakat lainnya" (16px white)
  * Button: "Daftar Sekarang ▶" (Navy solid, 16px bold, padding 14px 32px)
- Button hover: Scale 1.05, shadow
- Conditional: Hidden jika user sudah login

=== FOOTER UTAMA ===
- Background: Dark navy (#1A2A4A)
- Padding: 40px horizontal, 60px vertical

=== FOOTER CONTENT (Grid 4 Kolom) ===
**Column 1 - Tentang**
- Heading: "KOMET" (16px bold white)
- Links:
  * Tentang Kami (14px gray, hover orange)
  * Hubungi Kami (14px gray)
  * FAQ (14px gray)

**Column 2 - Navigasi**
- Heading: "Navigasi" (16px bold white)
- Links:
  * Home (14px gray, hover orange)
  * Kegiatan (14px gray)
  * Pengumuman (14px gray)
  * Timeline (14px gray)

**Column 3 - Sosial Media**
- Heading: "Ikuti Kami" (16px bold white)
- Icons (24px, white, hover orange):
  * Instagram (linked)
  * Facebook (linked)
  * WhatsApp (linked)
  * YouTube (linked)

**Column 4 - Kontak**
- Heading: "Kontak" (16px bold white)
- Email: komet@sibasket.id (14px gray, mailto link)
- Phone: +62 812 3456 7890 (14px gray)
- Address: Lapangan Indoor, Gedung Olahraga Kota (14px gray)

=== FOOTER BOTTOM ===
- Border-top: 1px #333
- Padding: 20px
- Content centered: "© 2026 SIBASKET - KOMET Basketball Club. All rights reserved." (12px gray)

=== RESPONSIVE ===
- Desktop: 4 kolom grid
- Tablet: 2 kolom grid
- Mobile: 1 kolom stack
```

---

## II. MASTER PROMPT LENGKAP (COPY SELURUH INI KE v0.dev)

```
Kamu adalah UI/UX designer senior dengan pengalaman 10+ tahun mendesain website olahraga dan platform manajemen komunitas.

Tugasmu: Buat desain landing page lengkap untuk "KOMET Basketball Club" (ekstrakurikuler basket di sekolah, bagian dari sistem SIBASKET).

PENTING: Hindari "AI slop" — gunakan design patterns yang proven, typography yang tegas, spacing yang lega, dan hindari dekorasi berlebihan atau ilustrasi kartun yang murahan.

=== DESAIN IDENTITAS ===

**WARNA:**
- Navy Blue (Primary): #1F3A5F
- Orange/Coral (CTA & Accent): #FF6B35
- Light Gray (Background): #F5F5F5
- White (Cards & Text BG): #FFFFFF
- Dark Gray (Text Body): #2C3E50
- Green (Success/Badge): #27AE60
- Red (Error/Alert): #E74C3C
- Light Orange (Hover State): #FFB399
- Dark Navy (Footer): #1A2A4A

**TYPOGRAPHY:**
- Font Family: Inter (primary), Poppins (accent)
- Headline 1 (Hero): 48px Bold, line-height 1.2, navy
- Headline 2 (Section Title): 32px Bold, navy
- Headline 3 (Card Title): 24px Bold, navy
- Body Text: 16px Regular, dark gray, line-height 1.6
- Small Text: 14px Regular, gray
- Caption: 12px Regular, light gray
- CTA Text: 14px Bold, white

**SPACING SYSTEM:**
- Base: 8px (multiplier: 4x, 8x, 12x, 16x, 20x, 24x, 32x, 48x, 64px)
- Section padding: 60px horizontal, 40px vertical (desktop), 40px horizontal, 24px vertical (mobile)
- Component gap: 16px - 32px
- Card padding: 20px - 40px

**BORDER & SHADOW:**
- Border-radius: 8px (buttons), 12px (cards), 16px (images)
- Shadow-sm: 0 1px 2px rgba(0,0,0,0.05)
- Shadow-md: 0 4px 6px rgba(0,0,0,0.07)
- Shadow-lg: 0 10px 15px rgba(0,0,0,0.1)

**TRANSITIONS:**
- Standard: 0.3s ease-in-out
- Quick: 0.15s ease-out
- Slow: 0.5s ease-in-out

=== HALAMAN: LANDING PAGE ===

**1. NAVBAR (Fixed Top, z-index: 1000)**
- Background: Navy dengan backdrop blur (rgba(31, 58, 95, 0.95))
- Height: 72px
- Padding: 0 24px
- Display: flex, justify-space-between, align-center

**Left (Logo):**
- Logo text: "KOMET" (20px bold white, letter-spacing 1px)
- Optional: Icon (basketball icon next to text)

**Center (Menu):**
- Flex gap: 8px
- Menu items: Home, About, Timeline, Kegiatan
- Style: Pills (12px bold, padding 8px 16px)
- Active: Orange bg (#FF6B35) + white text
- Inactive: White text, hover bg light gray
- Transition: 0.3s ease

**Right (CTA Buttons):**
- Gap: 12px
- Button 1: "Daftar Sekarang"
  * Background: Orange (#FF6B35)
  * Color: White
  * Padding: 10px 20px
  * Border-radius: 8px
  * Font: 14px bold
  * Hover: Scale 1.05, shadow increase
- Button 2: "Login"
  * Background: Transparent
  * Border: 2px white
  * Color: White
  * Padding: 8px 18px
  * Hover: Background light orange

**Responsive:**
- Tablet (768px): Menu items hidden, hamburger icon muncul
- Mobile: Hamburger menu expand full-width overlay

---

**2. HERO SECTION (Full-width, min-height 600px desktop)**
- Background: Image (lapangan basket) + overlay dark (rgba(0,0,0,0.4))
- Background-size: cover
- Display: flex, align-center, justify-center
- Position: relative

**Hero Content (Max-width 900px, centered):**
- Text-align: center
- Z-index: 10

**Headline:**
- Text: "KOMET: Lebih Dari Sekadar Tim, Kita Adalah Keluarga"
- Font-size: 48px (desktop), 32px (tablet), 24px (mobile)
- Font-weight: Bold
- Color: White
- Margin-bottom: 16px
- Line-height: 1.2

**Subheadline:**
- Text: "Mencetak atlet berprestasi dan membangun karakter melalui basket"
- Font-size: 18px (desktop), 14px (tablet & mobile)
- Color: rgba(255,255,255,0.85)
- Margin-bottom: 32px

**CTA Buttons (Flex horizontal, gap 12px, center):**
- Button 1: "Lihat Perjalanan Kami ▶"
  * Background: Orange (#FF6B35)
  * Color: White
  * Padding: 14px 28px
  * Font: 16px bold
  * Border-radius: 8px
- Button 2: "Gabung Sekarang ▶"
  * Background: Transparent
  * Border: 2px white
  * Color: White
  * Padding: 14px 28px
  * Font: 16px bold
- Hover: Scale 1.05, shadow glow

**Responsive:**
- Tablet: Buttons stack vertikal
- Mobile: Font sizes reduce 30%, buttons 100% width

---

**3. ABOUT SECTION (Background: White, padding 60px 24px)**
- Max-width: 1200px
- Margin: 0 auto
- Display: Grid (2 kolom desktop, 1 kolom mobile)
- Gap: 48px

**Left Column (40% width):**
- Image placeholder: 400x300px
- Border-radius: 16px
- Border: 4px solid orange
- Shadow: shadow-lg
- Object-fit: cover

**Right Column (60% width):**
- Heading: "Siapa Itu KOMET?" (32px bold navy)
- Margin-bottom: 16px
- Description: Long paragraph (16px gray, line-height 1.6)
- Margin-bottom: 32px

**Stats Grid (3 kolom):**
- Gap: 20px
- Each card:
  * Background: #F5F5F5
  * Padding: 20px
  * Border-radius: 12px
  * Border-top: 4px orange
  * Text-align: center
  * Big number: 24px bold orange
  * Label: 14px gray

---

**4. TIMELINE SECTION (Background: #F5F5F5, padding 60px 24px)**
- Max-width: 1200px
- Margin: 0 auto
- Heading: "Prestasi KOMET" (32px bold navy, text-center)
- Margin-bottom: 48px

**Timeline Container:**
- Position: relative
- Vertical garis di tengah (desktop): 3px navy
- Layout: Alternate left-right untuk 3 items

**Timeline Item (3x repeat):**
- Display: flex
- Gap: 32px
- Margin-bottom: 40px

**Item Card:**
- Background: White
- Padding: 24px
- Border-radius: 12px
- Border-left: 4px orange
- Shadow: shadow-md
- Width: 45% (pada desktop, left & right alternate)
- Content:
  * Year (18px bold navy): "2022"
  * Title (18px bold navy): "Juara 1 Walikota Cup"
  * Description (14px gray): "Prestasi pertama KOMET..."
  * Icon (medali, 32px, orange) positioned di timeline garis

**Image Placeholder:** 150x150px, border-radius 8px, object-cover

**Responsive:**
- Tablet/Mobile: Semua item center aligned, garis di kiri

---

**5. INFO SECTION (Background: White, padding 60px 24px)**
- Max-width: 1200px
- Margin: 0 auto
- Grid: 2 kolom (desktop), 1 kolom (tablet/mobile)
- Gap: 32px

**Left Column - Kegiatan Mendatang:**
- Heading: "Kegiatan Mendatang" (24px bold navy)
- Margin-bottom: 24px
- Cards (2x):
  * Background: White
  * Border: 1px #EEE
  * Border-top: 4px orange
  * Padding: 20px
  * Margin-bottom: 16px
  * Border-radius: 12px
  * Icon + Title + Meta (date, location)
  * Badge: "Terbuka" (green pill, 12px)

**Right Column - Pengumuman:**
- Heading: "Pengumuman Terbaru" (24px bold navy)
- Margin-bottom: 24px
- Items (2x):
  * Background: White
  * Border-left: 4px orange
  * Padding: 16px
  * Margin-bottom: 16px
  * Date (12px gray)
  * Title (16px bold navy)
  * Snippet (14px gray, max 2 baris)
  * Link: "Baca Selengkapnya ▶" (12px orange, hover underline)

---

**6. CTA BANNER (Background: Orange gradient, height 200px desktop)**
- Background: linear-gradient(135deg, #FF6B35, #FF8C5A)
- Padding: 40px 24px
- Display: flex, flex-direction column, justify-center, align-center
- Text-align: center
- Margin: 60px 0

**Content:**
- Heading: "Siap Menjadi Bagian dari Sejarah KOMET?" (32px bold white)
- Subheading: "Daftar sekarang dan bergabunglah..." (16px white)
- Button: "Daftar Sekarang ▶" (Navy solid, 14px bold)
- Margin-top: 16px

**Conditional CSS:**
```css
/* Hanya tampil untuk guest */
@media (has-class: .guest) {
  .cta-banner { display: block; }
}
/* Sembunyikan untuk member */
@media (has-class: .member) {
  .cta-banner { display: none; }
}
```

---

**7. FOOTER (Background: #1A2A4A, padding 60px 24px)**
- Max-width: 1200px
- Margin: 0 auto

**Footer Grid (4 kolom desktop, 2 tablet, 1 mobile):**
- Gap: 40px
- Column 1-4: Each has heading (16px bold white) + links (14px gray)

**Columns:**
1. Tentang: Links ke About, Contact, FAQ
2. Navigasi: Links ke Home, Kegiatan, Pengumuman, Timeline
3. Sosial: Icons Instagram, Facebook, WhatsApp, YouTube
4. Kontak: Email, Phone, Address (14px gray)

**Footer Bottom:**
- Border-top: 1px #333
- Padding: 24px 0
- Text-align: center
- Copyright: "© 2026 SIBASKET - KOMET Basketball Club" (12px gray)

---

=== RESPONSIVE BREAKPOINTS ===

**Desktop (1200px+):**
- Navbar: Full menu visible
- Hero: 600px height, 48px fonts
- Sections: Max-width 1200px, padding 60px
- Grid: 2+ kolom
- Timeline: Alternate left-right
- CTA Banner: 200px height

**Tablet (768px - 1199px):**
- Navbar: Hamburger menu
- Hero: 400px height, fonts -20%
- Sections: Padding 40px
- Grid: 2 kolom → 1 kolom stack
- Timeline: Center aligned, garis di kiri
- CTA Banner: 150px height

**Mobile (< 768px):**
- Navbar: Full-width hamburger overlay
- Hero: 300px height, fonts -50%
- Buttons: Stack vertical, 100% width
- Sections: Padding 24px
- Grid: 1 kolom
- Images: 100% width
- Cards: Stack vertical
- Footer: 1 kolom

---

=== INTERACTION & ANIMATION ===

**Hover States:**
- Buttons: Scale 1.05 + shadow increase
- Links: Color change to orange + underline fade-in
- Cards: Shadow increase + translate Y -2px
- Menu items: Background change + smooth color transition

**Focus States:**
- Inputs: Border 2px orange + outline none + shadow orange glow
- Links: Underline + outline offset 2px

**Transitions:**
- All: 0.3s ease-in-out
- Quick interactions: 0.15s
- Slow reveal: 0.5s

**Animations:**
- Fade-in on scroll (optional, untuk section)
- Button ripple effect on click

---

=== COMPONENT REUSABILITY ===

**Reusable Komponens:**
1. Button (Primary Orange, Secondary Navy, Outline)
2. Card (Info, Event, News)
3. Badge (Status: Terbuka, Mendatang, Closed)
4. Navigation Pill (Menu active/inactive)
5. Stats Box (Number + Label)
6. Timeline Item (Year + Title + Description)
7. Footer Link Block

---

=== ANTI AI-SLOP CHECKLIST ===

✓ Typography: Tegas, legible, minimal decoration
✓ Spacing: Generous whitespace, breathing room
✓ Colors: Terbatas pada 2 warna primary + neutral
✓ Images: Placeholder berkualitas atau solid color
✓ Icons: Minimal, konsisten style, purposeful
✓ Layout: Grid system yang ketat, alignment sempurna
✓ Interaction: Smooth, predictable, purposeful
✓ Responsive: Tested di semua breakpoint
✓ Font: Maximum 2 font families
✓ Shadow: Subtle, realistic, not overdone

---

=== OUTPUT YANG DIHARAPKAN ===

1. ✓ Fully responsive landing page
2. ✓ Clean, professional design tanpa AI-slop
3. ✓ All interactive elements (hover, focus states)
4. ✓ Proper spacing & typography hierarchy
5. ✓ Reusable component structure
6. ✓ Mobile-first approach
7. ✓ Accessibility compliance (color contrast, focus visible)
8. ✓ Performance optimized (minimal assets, smooth scrolling)

**Gunakan:** React + Next.js + Tailwind CSS
**Font:** Inter (primary), Poppins (accent)
**Build Tool:** Vite atau Turbopack
**Styling:** Tailwind utilities, custom component layer

**Jika ada ambiguitas, gunakan professional web design standards dan prioritaskan clarity + usability.**
```

---

## III. HALAMAN FORM (TERPISAH DARI LANDING PAGE)

### HALAMAN PENDAFTARAN

**Prompt:**
```
Buat halaman "Daftar Anggota KOMET" yang standalone (page berbeda dari landing page).

=== STRUCTURE ===
- Background: Light gray (#F5F5F5) full-width
- Container: White card, max-width 600px, centered, margin auto
- Padding: 40px
- Border-radius: 12px
- Shadow: shadow-lg

=== HEADER ===
- Logo KOMET (24px bold navy, text-align center)
- Margin-bottom: 24px
- Heading: "Bergabunglah dengan KOMET" (28px bold navy, text-align center)
- Subheading: "Isi formulir di bawah untuk mendaftar menjadi anggota" (14px gray, text-align center)
- Margin-bottom: 32px

=== FORM FIELDS (Grid 2 kolom responsive) ===
1. Nama Lengkap (full-width, required)
2. Nama Panggilan (full-width, required)
3. Jurusan (dropdown, required)
4. Jenis Kelamin (dropdown, required)
5. Nomor WA (full-width, required, validation)
6. Nomor Orang Tua (full-width, required)
7. Pengalaman Main Basket (radio: Ya / Tidak, required)
8. Orang Tua Mengetahui (radio: Ya / Tidak, required)
9. Alasan Bergabung (textarea, min 10 char, required)
10. Checkbox: "Saya setuju dengan peraturan KOMET" (required)

=== INPUT STYLING ===
- Label: 14px bold navy, margin-bottom 8px
- Input: 
  * Border: 1px #DDD
  * Padding: 12px 16px
  * Border-radius: 8px
  * Font: 14px gray
  * Focus: Border 2px orange, outline none, box-shadow: 0 0 0 3px rgba(255,107,53,0.1)
- Error message: 12px red, margin-top 4px
- Helper text: 12px light gray, italic

=== BUTTON STYLING ===
- Full-width grid 2 kolom (Cancel | Submit)
- Gap: 12px
- Cancel: Gray outline, 14px bold
- Submit: Orange solid, 14px bold, padding 14px
- Hover: Scale 1.02, shadow increase
- Active: Scale 0.98 (press effect)

=== VALIDATION ===
- Email format
- Nomor WA format: 08xxx
- Alasan minimal 10 karakter
- Checkbox harus checked

=== SUCCESS STATE ===
- Form berubah ke success card
- Background: Light green
- Icon: Checkmark (48px orange)
- Message: "Pendaftaran Berhasil!" (24px bold green)
- Sub-message: "Data Anda sudah diterima. Admin akan menghubungi dalam 1-2 hari kerja." (14px gray)
- Button: "Kembali ke Home" (navy solid, link ke /)

=== RESPONSIVE ===
- Desktop: 600px max-width, padding 40px
- Tablet: 100% width, padding 24px
- Mobile: 100% width, padding 16px, buttons stack vertical
```

### HALAMAN LOGIN

**Prompt:**
```
Buat halaman "Login SIBASKET" yang standalone (page berbeda dari landing page).

=== STRUCTURE ===
- Background: Light gray (#F5F5F5) full-width
- Container: White card, max-width 500px, centered, margin auto
- Padding: 40px
- Border-radius: 12px
- Shadow: shadow-lg

=== HEADER ===
- Logo KOMET (32px bold navy, text-align center)
- Margin-bottom: 32px
- Heading: "Login KOMET" (24px bold navy, text-align center)
- Subheading: "Masuk untuk akses dashboard member" (14px gray, text-align center)
- Margin-bottom: 24px

=== FORM FIELDS ===
1. Email (full-width, required, validation)
2. Password (full-width, required, type password)
3. "Lupa Password?" link (12px orange, right-aligned, hover underline)

=== INPUT STYLING ===
- Label: 14px bold navy, margin-bottom 8px
- Input:
  * Border: 1px #DDD
  * Padding: 12px 16px
  * Border-radius: 8px
  * Font: 14px
  * Focus: Border 2px orange, outline none, shadow light orange
- Error message: 12px red

=== BUTTONS ===
- Login Button: Navy solid, full-width, 14px bold, padding 14px
- Margin-top: 24px
- Hover: Scale 1.02, shadow increase

=== FOOTER LINKS ===
- Text: "Belum punya akun? " (14px gray)
- Link: "Daftar di sini" (14px orange bold, link ke /daftar-anggota)
- Text-align: center
- Margin-top: 24px

=== ERROR STATE ===
- Banner merah di atas form: "Email atau password salah" (14px red)
- Background: Light red (#FFE8E8)
- Padding: 12px 16px
- Border-radius: 8px
- Border-left: 4px red

=== RESPONSIVE ===
- Desktop: 500px max-width, padding 40px
- Tablet: 100% width, padding 24px
- Mobile: 100% width, padding 16px
```

---

## IV. CATATAN PENTING

### ✅ UNTUK MENGHINDARI AI-SLOP:
1. **Typography**: Gunakan maksimal 2 font, font-size yang tegas dan kontras
2. **Spacing**: Whitespace yang lega (jangan packed-packed)
3. **Colors**: Terbatas pada 5-6 warna utama (jangan banyak-banyak)
4. **Icons**: Minimal, purposeful, consistent style
5. **Images**: Placeholder berkualitas atau solid color (hindari AI-generated illustrations)
6. **Layout**: Grid-based, alignment sempurna
7. **Interaction**: Smooth, predictable transitions (0.2-0.3s)
8. **Components**: Reusable, modular, DRY principle

### 📋 CHECKLIST DESAIN:
- [ ] All text legible (color contrast WCAG AA minimum)
- [ ] All buttons clickable dengan minimum 44px touch target
- [ ] Responsive tested di 3 breakpoints
- [ ] Hover/focus states for all interactive elements
- [ ] Consistent typography hierarchy
- [ ] Whitespace breathing room
- [ ] Professional color palette
- [ ] No overdone shadows or effects
- [ ] Accessibility: alt-text, semantic HTML
- [ ] Performance: minimal assets, lazy-load images

---

---

## IV. HALAMAN MEMBER PROFILE & SETTINGS (SETELAH LOGIN)

### MEMBER DASHBOARD LAYOUT

**Prompt:**
```
Buat desain member dashboard untuk KOMET setelah user login.

=== NAVBAR (Fixed Top, sama seperti landing tapi ada perubahan) ===
- Background: Navy (#1F3A5F) dengan blur
- Height: 72px
- Logo KOMET (kiri)
- Menu Center: Home | Kegiatan | Timeline | Galeri
- Right: Dropdown Profile ("Nama Anggota ▼")
  * Menu dropdown:
    - Profil Saya (link ke /dashboard/profile)
    - Kegiatan Saya (link ke /dashboard/kegiatan-saya)
    - Settings (link ke /dashboard/settings)
    - Logout (red text, click logout)

=== SIDEBAR (Fixed Kiri, 200px) ===
- Background: Light gray (#F5F5F5)
- Menu items:
  * Dashboard (icon: home, link: /dashboard)
  * Profil Saya (icon: user, link: /dashboard/profile)
  * Kegiatan Saya (icon: calendar, link: /dashboard/kegiatan-saya)
  * Absensi (icon: clipboard, link: /dashboard/absensi)
  * Settings (icon: gear, link: /dashboard/settings)
  * Logout (icon: exit, color: red, link: /logout)
- Active item: Navy bg + white text + orange left border (4px)
- Hover: Light gray bg, color navy

=== MAIN CONTENT AREA ===
- Margin-left: 200px (desktop)
- Padding: 24px
- Background: Light gray (#F5F5F5)
- Responsive: Sidebar collapsible di tablet/mobile
```

### PROFILE PAGE

**Prompt:**
```
Buat halaman "Profil Saya" untuk member KOMET.

=== HEADER SECTION ===
- Title: "Profil Saya" (32px bold navy)
- Breadcrumb: Dashboard > Profil Saya

=== MAIN CONTENT (2 Kolom Grid, responsive 1 mobile) ===

**LEFT COLUMN (35% width):**
- Card: "Foto Profil"
  * Background: White, padding 24px, border-radius 12px, shadow-md
  * Foto profil (circular, 200x200px, border 4px orange)
  * Nama anggota (20px bold navy, center)
  * Status badge: "Anggota Aktif" (green pill, 12px, center)
  * Margin-top: 16px
  * Button: "Ubah Foto" (orange outline, 12px bold, full-width)
  * Button: "Hapus Foto" (gray outline, 12px, full-width, margin-top 8px)

**RIGHT COLUMN (65% width):**
- Card: "Informasi Profil"
  * Background: White, padding 24px, border-radius 12px, shadow-md
  * Heading: "Data Pribadi" (18px bold navy)
  * Grid 2 kolom (responsive 1 mobile):
    - Label "Nama Lengkap" → Value (14px gray) | Edit button (pencil icon, hover orange)
    - Label "Nama Panggilan" → Value | Edit button
    - Label "Email" → Value | Edit button
    - Label "Nomor WA" → Value | Edit button
    - Label "Jurusan" → Value | Edit button
    - Label "Jenis Kelamin" → Value | Edit button
  * Margin-bottom: 24px

- Card: "Biodata Tambahan"
  * Heading: "Tentang Saya" (18px bold navy)
  * Textarea: Biodata (placeholder: "Tulis sedikit tentang dirimu...")
  * Word count: "(0/500 karakter)" (12px gray, right)
  * Button: "Simpan Biodata" (orange solid, 12px, margin-top 12px)

- Card: "Statistik"
  * Heading: "Statistik Keikutsertaan" (18px bold navy)
  * Grid 3 kolom:
    - Stat 1: "Kegiatan Diikuti" → "12" (24px bold orange)
    - Stat 2: "Tingkat Kehadiran" → "95%" (24px bold orange)
    - Stat 3: "Medali" → "3" (24px bold orange)

=== EDIT MODE ===
- Ketika user klik "Edit" di label, input field muncul dengan border orange
- Save & Cancel buttons muncul
- Auto-save atau manual save
```

### SETTINGS PAGE

**Prompt:**
```
Buat halaman "Settings" untuk member KOMET.

=== MAIN CONTENT ===

**Section 1: Keamanan Akun**
- Card: White bg, padding 24px, margin-bottom 24px
- Heading: "Keamanan Akun" (18px bold navy)
- Item 1: "Ubah Password"
  * Current Password (input, type password)
  * New Password (input, type password)
  * Confirm Password (input, type password)
  * Password strength indicator (weak/medium/strong)
  * Button: "Ubah Password" (orange solid)
- Item 2: "Verifikasi Email"
  * Email saat ini: email@sibasket.id (14px gray)
  * Button: "Verifikasi Email Baru" (navy outline)
  * Status: "Email terverifikasi ✓" (green text, 12px)

**Section 2: Preferensi**
- Card: White bg, padding 24px, margin-bottom 24px
- Heading: "Preferensi Notifikasi" (18px bold navy)
- Toggle 1: "Notifikasi Email" (default ON)
  * Label: "Terima email untuk kegiatan baru, pengumuman, dll" (14px gray)
- Toggle 2: "Notifikasi Push" (default ON)
  * Label: "Terima notifikasi push di browser" (14px gray)
- Toggle 3: "Notifikasi WA" (default OFF)
  * Label: "Terima pesan WA untuk jadwal latihan" (14px gray)

**Section 3: Akun**
- Card: White bg, padding 24px, border-left 4px red, margin-bottom 24px
- Heading: "Akun Saya" (18px bold navy)
- Item 1: "Download Data Saya"
  * Text: "Download semua data pribadi dan aktivitas Anda dalam format ZIP" (14px gray)
  * Button: "Download Data" (navy solid, 12px)
- Item 2: "Hapus Akun"
  * Text: "Menghapus akun akan menghapus semua data Anda secara permanen. Tindakan ini tidak dapat dibatalkan." (14px red, italic)
  * Button: "Hapus Akun" (red solid, 12px)
  * Confirmation modal: "Yakin hapus akun? Ketik 'HAPUS' untuk konfirmasi"
```

---

## V. HALAMAN GALERI DOKUMENTASI (PUBLIC atau MEMBER-ONLY)

### GALERI DOKUMENTASI

**Prompt:**
```
Buat halaman "Galeri KOMET" untuk showcase foto dokumentasi perjalanan klub basket.

=== NAVBAR ===
- Sama seperti landing page (berubah jika member login)

=== PAGE HEADER ===
- Heading: "Galeri KOMET" (32px bold navy)
- Subheading: "Momen-momen berharga dari perjalanan kami bersama" (16px gray)
- Breadcrumb: Home > Galeri KOMET

=== FILTER BAR ===
- Dropdown: "Kategori: [Semua / Latihan / Turnamen / Sosial / Dokumentasi]"
- Search: "Cari foto..." (input search)
- Sort: "Terbaru" / "Terpopuler"
- Filter button active: bg orange, white text

=== GALLERY GRID ===
- Layout: Masonry grid (Pinterest-style)
- Desktop: 4 kolom
- Tablet: 3 kolom
- Mobile: 2 kolom
- Gap: 16px

**Gallery Item Card:**
- Image: Aspect ratio varies (bukan forced), object-fit cover
- Border-radius: 8px
- Overlay (on hover):
  * Background: rgba(0,0,0,0.5)
  * Content: "▶ Lihat" button (white text, center)
  * Fade-in transition 0.3s
- Below image:
  * Title (16px bold navy, margin-top 8px)
  * Date (12px gray, icon calendar)
  * Badge: "Turnamen" atau "Latihan" (orange pill, 10px)

=== LIGHTBOX / MODAL ===
- Klik foto → Fullscreen modal
- Black background overlay
- Foto besar di tengah
- Navigation buttons: < Previous | Next >
- Close button (X, top-right, 24px)
- Photo info (bottom): Title, date, description
- Download button (blue outline, bottom-right)
- Share buttons (Instagram, Facebook, WhatsApp)

=== PAGINATION ===
- "Showing 1-12 of 50+ photos"
- Page buttons: 1 2 3 ... [Next]
- Load More button alternative: "Muat Lebih Banyak" (navy solid, full-width)

=== RESPONSIVE ===
- Desktop: 4 kolom masonry
- Tablet: 3 kolom, modal fullscreen
- Mobile: 2 kolom, modal 90% screen width

=== PERFORMANCE ===
- Lazy loading untuk images
- Thumbnail loading state (skeleton)
- Lightbox images: High-res version
```

### ADMIN UPLOAD GALERI (Bonus - untuk admin tambah foto)

**Prompt:**
```
Buat halaman "Manage Galeri" untuk admin KOMET (di dashboard admin).

=== LAYOUT ===
- Sidebar menu: Galeri (admin-only)
- Main content: Max-width 1200px

=== HEADER ===
- Title: "Kelola Galeri KOMET" (32px bold navy)
- Button: "+ Tambah Foto" (orange solid, right-aligned)

=== UPLOAD FORM (Modal) ===
- Title: "Upload Foto Baru"
- Image input: Drag & drop atau click to browse
- File size limit: Max 5MB
- Accepted formats: JPG, PNG
- Title input (required)
- Kategori dropdown: Latihan / Turnamen / Sosial / Dokumentasi
- Deskripsi textarea (optional)
- Buttons: Cancel | Upload

=== GALERI LIST (Tabel) ===
- Columns: No | Thumbnail (50x50px) | Judul | Kategori | Upload Date | Views | Actions
- Actions: Edit (icon pencil) | Delete (icon trash, red) | Preview (icon eye)
- Delete confirmation: "Yakin hapus foto?"
- Edit: Pop title, kategori, deskripsi
- Pagination: 10 items per page
```

---

## VI. CATATAN INTEGRASI DENGAN LARAVEL

### Routes yang Diperlukan (Tambahan):
```
// Member Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/profile', [MemberController::class, 'profile'])->name('member.profile');
    Route::post('/dashboard/profile', [MemberController::class, 'updateProfile'])->name('member.updateProfile');
    Route::get('/dashboard/settings', [MemberController::class, 'settings'])->name('member.settings');
    Route::post('/dashboard/settings', [MemberController::class, 'updateSettings'])->name('member.updateSettings');
    Route::post('/dashboard/profile/upload-photo', [MemberController::class, 'uploadPhoto'])->name('member.uploadPhoto');
});

// Public Gallery
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Admin Gallery Management
Route::middleware(['auth', 'can:manage galeri'])->group(function () {
    Route::get('/dashboard/galeri', [GalleryController::class, 'manage'])->name('gallery.manage');
    Route::post('/dashboard/galeri', [GalleryController::class, 'store'])->name('gallery.store');
    Route::post('/dashboard/galeri/{id}/delete', [GalleryController::class, 'destroy'])->name('gallery.destroy');
});
```

### Livewire Components yang Diperlukan:
- `MemberProfileTable` — Edit profil, foto, biodata
- `MemberSettingsForm` — Settings notifikasi, password
- `GalleryGrid` — Display galeri dengan filter & search
- `GalleryUpload` — Upload foto untuk admin

### Database Schema (tambahan):
```sql
-- Gallery table
ALTER TABLE galleries ADD COLUMN (
    user_upload_id INT,
    category ENUM('latihan', 'turnamen', 'sosial', 'dokumentasi'),
    description TEXT,
    views_count INT DEFAULT 0,
    FOREIGN KEY (user_upload_id) REFERENCES users(id)
);

-- Member Profile Extension
ALTER TABLE anggotas ADD COLUMN (
    biodata TEXT,
    profile_photo_path VARCHAR(255),
    phone_number VARCHAR(20)
);
```

---

## VII. CHECKLIST IMPLEMENTASI

**Landing Page:**
- [ ] Navbar + Logo
- [ ] Hero section
- [ ] About section
- [ ] Timeline prestasi
- [ ] Info kegiatan & pengumuman
- [ ] CTA banner (guest-only)
- [ ] Footer

**Guest Pages:**
- [ ] Login page
- [ ] Daftar page

**Member Pages:**
- [ ] Member navbar (dropdown profile)
- [ ] Profile page (edit biodata, ganti foto)
- [ ] Settings page (notifikasi, password, hapus akun)

**Public Pages:**
- [ ] Gallery page (filter, search, lightbox)

**Admin Pages:**
- [ ] Gallery management (upload, delete)

---


## VIII. FITUR TAMBAHAN (WAJIB ADA)

### 1️⃣ MEMBER DASHBOARD HOME (Landing Page Member)
**Prompt:**
```
Buat halaman Dashboard Home untuk member KOMET.
- Header: "Halo, [Nama Member]! 👋"
- Quick Stats Grid (3 kolom):
  - Kegiatan Mendatang: [Jumlah] (Badge Orange)
  - Kehadiran Bulan Ini: [Persentase]% (Badge Green)
  - Notifikasi Baru: [Jumlah] (Badge Red)
- Recent Activities: List card untuk pengumuman atau perubahan status pendaftaran.
- Shortcut Buttons: "Daftar Kegiatan", "Lihat Absensi", "Edit Profil".
```

### 2️⃣ KEGIATAN SAYA (Member View)
**Prompt:**
```
Buat halaman "Kegiatan Saya" untuk member.
- Tab: [Semua | Mendatang | Selesai]
- Table/List: Judul Kegiatan | Tanggal | Lokasi | Status (Pending/Approved/Ditolak/Selesai).
- Tombol aksi: "Lihat Detail" (Navy outline).
```

### 3️⃣ DETAIL PENGUMUMAN (Public)
**Prompt:**
```
Buat halaman detail pengumuman.
- Judul Besar (H1, Navy, Bold).
- Meta: Tanggal, Kategori, Penulis.
- Konten: Teks panjang, gambar di tengah, format paragraf bersih.
- Button: "Kembali ke Beranda" (Gray).
```

### 4️⃣ NOTIFICATION SYSTEM (Navbar)
**Prompt:**
```
Buat komponen notifikasi di Navbar.
- Ikon: Bel (dengan badge merah jumlah notifikasi).
- Dropdown: List notifikasi dengan status (unread/read).
- Link: "Lihat Semua Notifikasi".
```

### 5️⃣ 404 ERROR PAGE (Branded KOMET)
**Prompt:**
```
Buat halaman 404 Error.
- Visual: Ilustrasi basket nyasar (minimalis).
- Text: "Oops! Sepertinya bolanya keluar lapangan (404)".
- Tombol: "Kembali ke Beranda" (Orange solid).
```

