# 🏀 SI-BASKET: PROMPT DESIGN WEB PUBLIK (LANDING PAGE + PUBLIC PAGES)

**Khusus untuk halaman-halaman yang bisa diakses tanpa login**

Copy-paste prompt ini ke v0.dev atau AI design generator untuk membuat web publik SI-BASKET.

---

## PROMPT LENGKAP WEB PUBLIK (COPY LANGSUNG KE v0.dev)

```
Kamu adalah UI/UX designer profesional untuk aplikasi web modern.

Buat design lengkap **WEB PUBLIK SI-BASKET** (halaman-halaman yang bisa diakses tanpa login) dengan teknologi React + Next.js + Tailwind CSS.

=== APLIKASI OVERVIEW ===

**Nama:** SI-BASKET - Sistem Manajemen Organisasi Basket
**Tujuan:** Website publik untuk promosi organisasi basket, tampilkan kegiatan, pengumuman, dan rekrut anggota baru
**Target User:** Pengunjung umum, calon anggota, orangtua/wali, publik yang tertarik basket
**Device:** Desktop-first, responsive (tablet & mobile)
**Inspirasi Design:** Rallyo Club (modern, sporty, clean, energetic)

=== COLOR PALETTE ===

Primary: Navy Blue #1F3A5F (profesional, trust)
Secondary: Orange/Coral #FF6B35 (energi, action, basketball vibe)
Background: Off-white #F5F5F5 (clean, modern)
Cards: White #FFFFFF (content containers)
Text: Dark Gray #2C3E50 (body text)
Text Light: Gray #6B7280 (secondary text)
Success: Green #27AE60 (status badges)
Overlay: rgba(0, 0, 0, 0.4) (untuk hero background)

=== TYPOGRAPHY ===

Font Family: Inter, Poppins, atau Montserrat (modern sans-serif)

Desktop:
- Hero Headline: 48px Bold
- Page Title (H1): 36px Bold
- Section Title (H2): 28px Semi-bold
- Card Title (H3): 20px Bold
- Body Large: 18px Regular
- Body: 16px Regular
- Body Small: 14px Regular
- Caption: 12px Regular

Mobile:
- Hero Headline: 32px Bold
- Page Title: 28px Bold
- Section Title: 24px Semi-bold
- Card Title: 18px Bold
- Body: 14px Regular

Line Height: 1.6 untuk body text, 1.2 untuk headings

=== HALAMAN 1: LANDING PAGE (HOME) ===

--- NAVBAR (Fixed/Sticky di atas semua halaman) ---

Position: Fixed top, z-index 1000
Background: Navy Blue semi-transparent rgba(31, 58, 95, 0.95) dengan backdrop-blur effect
Height: 72px (desktop), 64px (mobile)
Padding: 16px 40px (desktop), 12px 16px (mobile)
Border-bottom: 1px solid rgba(255, 255, 255, 0.1)
Shadow: Subtle (0 2px 8px rgba(0, 0, 0, 0.1))

Layout: [Logo] [Menu Items] [Search] [Login Button] [Hamburger]

1. LOGO (Kiri):
   - Icon: Basketball icon atau custom logo
   - Text: "SI-BASKET"
   - Font: 24px Bold
   - Color: White
   - Hover: Opacity 80%, cursor pointer
   - Gap antara icon & text: 8px

2. MENU ITEMS (Tengah-kiri):
   Display: Horizontal flex, gap 16px
   Hide di mobile (<768px), show hamburger menu
   
   Menu: "Beranda" | "Kegiatan" | "Pengumuman" | "Tentang Kami"
   
   Styling per item:
   - Rounded-full pill buttons
   - Padding: 8px 20px
   - Font: 14px Medium
   - Color: White (default)
   - Background: Transparent (default)
   - Active state: Orange background #FF6B35, white text
   - Hover state: Orange background 80% opacity, white text
   - Transition: 0.3s smooth
   
3. SEARCH BAR (Tengah-kanan):
   Width: 240px (tablet: 180px, mobile: hidden)
   Height: 40px
   Border-radius: 8px
   Background: rgba(255, 255, 255, 0.15)
   Border: 1px solid rgba(255, 255, 255, 0.3)
   Padding: 10px 16px
   
   Placeholder: "Cari kegiatan..."
   Placeholder color: rgba(255, 255, 255, 0.6)
   Text color: White
   Icon: Search icon di dalam input (kanan)
   
   Focus state:
   - Border: 2px solid Orange #FF6B35
   - Background: rgba(255, 255, 255, 0.25)
   - Shadow: 0 0 0 3px rgba(255, 107, 53, 0.2)

4. LOGIN BUTTON (Kanan):
   Label: "Login"
   Background: Transparent
   Border: 2px solid White
   Color: White
   Padding: 10px 28px
   Border-radius: 8px
   Font: 14px Medium
   
   Hover:
   - Background: White
   - Color: Navy
   - Transform: scale(1.05)
   - Shadow: 0 4px 12px rgba(255, 255, 255, 0.3)
   Transition: 0.3s

5. HAMBURGER MENU (Mobile only):
   Display: None (desktop/tablet), Block (mobile <768px)
   Icon: 3 horizontal lines (☰), 24px
   Color: White
   Position: Far right
   Click behavior: Open full-screen overlay menu dengan backdrop

--- HERO SECTION ---

Layout Structure:
- Full viewport width
- Min-height: 600px (desktop), 500px (tablet), 400px (mobile)
- Position: Relative
- Display: Flex, align-items center, justify-content center

Background Layer:
- Background image: Lapangan basket outdoor dengan pemain (high quality, energetic)
- Object-fit: Cover
- Object-position: Center
- Overlay: rgba(0, 0, 0, 0.4) (dark transparent layer untuk readability)

Content Container (White Card):
Background: White #FFFFFF
Max-width: 640px
Padding: 48px (desktop), 36px (tablet), 24px (mobile)
Border-radius: 24px (rounded-3xl)
Shadow: 0 20px 60px rgba(0, 0, 0, 0.15) (shadow-2xl)
Position: Centered (margin auto)
Display: Flex flex-direction column
Gap: 24px

--- Dalam Content Container ---

A. CAROUSEL FOTO (Top section):
   Display: Image carousel dengan auto-play
   Height: 300px (desktop), 240px (tablet), 200px (mobile)
   Border-radius: 16px
   Overflow: Hidden
   
   Foto Slides: 3-5 gambar (basketball players, latihan, kompetisi)
   Object-fit: Cover
   Transition: Smooth fade or slide (0.5s ease-in-out)
   Auto-play: 5 detik per slide
   
   Navigation:
   - Arrow buttons: ◀ ▶ di kiri & kanan (32px, semi-transparent bg)
   - Dot indicators di bawah carousel:
     * Size: 8px circular dots
     * Color: Navy #1F3A5F (default), Orange #FF6B35 (active)
     * Gap: 12px between dots
     * Position: Center aligned, margin-top 16px

B. HEADLINE:
   Text: "Bangun Komunitas, Raih Prestasi"
   Font: 48px Bold (desktop), 32px Bold (mobile)
   Color: Navy Blue #1F3A5F
   Line-height: 1.2
   Text-align: Center
   Margin-top: 24px

C. SUBHEADLINE:
   Text: "Bergabunglah dengan komunitas basket kami. Latihan rutin, kegiatan menarik, dan kesempatan berkompetisi menanti Anda."
   Font: 18px Regular (desktop), 16px Regular (mobile)
   Color: Dark Gray #2C3E50
   Opacity: 85%
   Line-height: 1.6
   Text-align: Center
   Margin-top: 16px
   Max-width: 500px
   Margin: Auto

D. ACTION BUTTONS (Bottom section):
   Display: Flex, gap 16px, justify-content center
   Margin-top: 32px
   Flex-wrap: Wrap (mobile: stack vertical dengan full-width)
   
   Button 1 - "Lihat Kegiatan ▶":
   - Background: Orange #FF6B35
   - Color: White
   - Padding: 14px 32px
   - Border-radius: 8px
   - Font: 16px Bold
   - Icon: Arrow right (▶) setelah text, gap 8px
   - Shadow: 0 4px 12px rgba(255, 107, 53, 0.3)
   - Hover: Background darker orange (#E85A2A), scale 1.05, shadow increase
   - Transition: 0.3s
   
   Button 2 - "Daftar Sekarang ▶":
   - Background: Transparent
   - Border: 2px solid Navy #1F3A5F
   - Color: Navy #1F3A5F
   - Padding: 14px 32px
   - Border-radius: 8px
   - Font: 16px Bold
   - Icon: Arrow right (▶) setelah text, gap 8px
   - Hover: Background Navy, color White, scale 1.05
   - Transition: 0.3s

--- SECTION KEGIATAN TERBARU (Below Hero) ---

Container:
- Background: Light gray #F5F5F5
- Padding: 80px 40px (desktop), 60px 24px (tablet), 40px 16px (mobile)

Section Header:
- Title: "Kegiatan Terbaru"
  * Font: 36px Bold, Navy color
  * Text-align: Center
  * Margin-bottom: 12px
  
- Subtitle: "Daftar latihan dan event yang akan datang"
  * Font: 18px Regular, Gray color
  * Text-align: Center
  * Margin-bottom: 40px

Cards Grid:
- Display: Grid
- Columns: 3 (desktop >1200px), 2 (tablet 768-1199px), 1 (mobile <768px)
- Gap: 24px
- Max-width: 1200px
- Margin: Auto

Card Kegiatan (per item):
Background: White
Border-radius: 16px
Overflow: Hidden
Shadow: 0 4px 12px rgba(0, 0, 0, 0.08)
Transition: 0.3s

Hover state:
- Shadow: 0 8px 24px rgba(0, 0, 0, 0.15)
- Transform: translateY(-4px)

Card Structure:
┌─────────────────────────┐
│ Foto Kegiatan (4:3)     │ ← Height 200px, object-fit cover
├─────────────────────────┤
│ Content Area            │
│ • Badge Tanggal         │ ← 12px, orange pill badge
│ • Nama Kegiatan         │ ← 18px bold navy
│ • 🗺️ Lokasi            │ ← 14px gray dengan icon
│ • [Lihat Detail ▶]     │ ← Link button
└─────────────────────────┘

Content Padding: 20px

1. Foto Kegiatan:
   - Aspect ratio: 4:3
   - Height: 200px
   - Object-fit: Cover
   - Background: Light gray (jika loading)

2. Badge Tanggal:
   - Font: 12px Medium
   - Color: Orange #FF6B35
   - Background: rgba(255, 107, 53, 0.1)
   - Padding: 4px 12px
   - Border-radius: 12px (pill)
   - Margin-bottom: 12px
   - Text: "18 Okt 2026 | 14:00 - 16:00"

3. Nama Kegiatan:
   - Font: 18px Bold
   - Color: Navy #1F3A5F
   - Margin-bottom: 8px
   - Line-height: 1.3
   - Text: "Latihan Rutin Basket"

4. Lokasi:
   - Font: 14px Regular
   - Color: Gray #6B7280
   - Margin-bottom: 16px
   - Icon: Map pin (🗺️) sebelum text, gap 6px
   - Text: "Lapangan Basket Kota, Jl. Merdeka No.5"

5. Link Button "Lihat Detail ▶":
   - Font: 14px Medium
   - Color: Navy #1F3A5F
   - Text-decoration: None (default)
   - Hover: Color Orange, underline, arrow shift right
   - Icon: Arrow right (▶) setelah text
   - Transition: 0.2s

Button "Lihat Semua Kegiatan":
- Margin-top: 40px
- Text-align: Center
- Button styling: Outline navy, padding 12px 32px, hover solid navy

--- SECTION PENGUMUMAN TERBARU ---

Styling sama seperti Section Kegiatan, tapi dengan card yang berbeda:

Card Pengumuman:
Background: White
Border-radius: 12px
Border-left: 5px solid Orange (accent)
Padding: 24px
Shadow: 0 2px 8px rgba(0, 0, 0, 0.06)
Hover: Shadow increase

Card Content:
1. Status Badge (top-right atau top-left):
   - Color: Orange/Green/Red (based on priority)
   - Font: 12px Medium
   - Padding: 4px 12px
   - Border-radius: 8px (pill)

2. Tanggal:
   - Font: 12px Regular
   - Color: Gray #6B7280
   - Text: "18 Oktober 2026"

3. Judul Pengumuman:
   - Font: 18px Bold
   - Color: Navy #1F3A5F
   - Margin-top: 8px
   - Margin-bottom: 12px
   - Text: "Event Turnamen Basketball Antar Sekolah"

4. Preview Isi:
   - Font: 14px Regular
   - Color: Gray #6B7280
   - Line-height: 1.6
   - Max-lines: 3 (dengan text ellipsis "...")
   - Margin-bottom: 12px
   - Text: "Kami dengan senang hati mengumumkan akan diadakan turnamen basketball antar sekolah pada bulan depan..."

5. Link "Selengkapnya ▶":
   - Font: 14px Medium
   - Color: Navy
   - Hover: Color Orange, underline

Button "Lihat Semua Pengumuman" di bawah grid

--- FOOTER ---

Background: Navy #1F3A5F
Color: White
Padding: 60px 40px 40px

Layout: 3 kolom (desktop), 1 kolom (mobile stack)

Kolom 1 - About:
- Logo + Tagline
- Short description organisasi basket

Kolom 2 - Quick Links:
- Beranda
- Kegiatan
- Pengumuman
- Tentang Kami
- Login

Kolom 3 - Kontak:
- Email
- Telepon
- Alamat
- Social media icons (Instagram, Facebook, Twitter)

Bottom Bar:
- Border-top: 1px solid rgba(255, 255, 255, 0.1)
- Padding-top: 24px
- Text: "© 2026 SI-BASKET. All rights reserved."
- Font: 12px Regular
- Color: rgba(255, 255, 255, 0.7)
- Text-align: Center

=== HALAMAN 2: KEGIATAN PUBLIK (LIST PAGE) ===

--- NAVBAR: Sama seperti Landing Page ---

--- PAGE HEADER ---

Background: White
Padding: 60px 40px 40px (desktop), 40px 24px 24px (mobile)
Border-bottom: 1px solid #E0E0E0

Title: "Kegiatan Terbaru"
- Font: 36px Bold (desktop), 28px Bold (mobile)
- Color: Navy #1F3A5F
- Text-align: Center
- Margin-bottom: 12px

Subtitle: "Daftar latihan rutin dan event yang akan datang"
- Font: 18px Regular (desktop), 16px Regular (mobile)
- Color: Gray #6B7280
- Text-align: Center

--- FILTER BAR ---

Background: Light gray #F5F5F5
Padding: 24px 40px (desktop), 20px 16px (mobile)
Display: Flex, gap 16px, justify-content space-between
Flex-wrap: Wrap (mobile)

1. Search Input:
   - Width: 300px (desktop), full-width (mobile)
   - Placeholder: "Cari nama kegiatan..."
   - Border: 1px solid #DDD
   - Border-radius: 8px
   - Padding: 10px 16px
   - Icon: Search di dalam input (left)

2. Filter Dropdown:
   - Label: "Status:"
   - Options: Semua | Akan Datang | Berlangsung | Selesai
   - Width: 180px (desktop), full-width (mobile)
   - Border: 1px solid #DDD
   - Border-radius: 8px
   - Padding: 10px 16px

3. Sort Dropdown:
   - Label: "Urutkan:"
   - Options: Terbaru | Terlama | A-Z
   - Width: 150px (desktop), full-width (mobile)

--- GRID KEGIATAN ---

Container:
- Background: White
- Padding: 60px 40px (desktop), 40px 16px (mobile)
- Max-width: 1200px
- Margin: Auto

Grid Layout: Sama seperti Landing Page Section Kegiatan
- 3 kolom (desktop), 2 kolom (tablet), 1 kolom (mobile)
- Gap: 24px

Card Kegiatan: Sama styling seperti di Landing Page

Jika tidak ada data:
- Empty state illustration
- Text: "Belum ada kegiatan tersedia"
- Font: 18px Regular, Gray
- Text-align: Center

--- PAGINATION ---

Container:
- Padding: 40px
- Display: Flex, justify-content center, align-items center
- Gap: 8px

Info Text:
- Font: 14px Regular
- Color: Gray
- Text: "Menampilkan 1-9 dari 25 kegiatan"
- Margin-right: 24px

Page Buttons:
- Buttons: ◀ [1] [2] [3] ... [8] ▶
- Size: 40px x 40px
- Border: 1px solid #DDD
- Border-radius: 8px
- Font: 14px Medium
- Color: Navy (default), White (active)
- Background: White (default), Orange (active)
- Hover: Border orange, background light orange
- Disabled: Opacity 50%, cursor not-allowed

=== HALAMAN 3: DETAIL KEGIATAN ===

--- NAVBAR: Sama ---

--- BREADCRUMB ---

Container:
- Background: White
- Padding: 16px 40px (desktop), 12px 16px (mobile)
- Border-bottom: 1px solid #E0E0E0

Text: "Beranda > Kegiatan > Latihan Rutin Basket"
- Font: 14px Regular
- Color: Gray
- Separator: >
- Last item (current page): Bold, Navy color

Back Button:
- Label: "◀ Kembali"
- Font: 14px Medium
- Color: Navy
- Hover: Color Orange
- Position: Left side

--- HERO IMAGE ---

Width: Full viewport width
Height: 400px (desktop), 300px (tablet), 240px (mobile)
Object-fit: Cover
Object-position: Center
Image: Foto kegiatan yang dipilih (high resolution)

--- CONTENT CONTAINER ---

Background: White
Max-width: 900px
Margin: -80px auto 60px (overlap dengan hero image) - Desktop
Margin: -40px 16px 40px (mobile)
Padding: 48px (desktop), 32px (mobile)
Border-radius: 16px
Shadow: 0 10px 40px rgba(0, 0, 0, 0.1)
Position: Relative

--- CONTENT SECTIONS ---

A. HEADER SECTION:

Title: "Latihan Rutin Basket"
- Font: 32px Bold (desktop), 24px Bold (mobile)
- Color: Navy #1F3A5F
- Margin-bottom: 8px

Subtitle: "Kegiatan Mingguan"
- Font: 16px Regular
- Color: Gray #6B7280
- Margin-bottom: 32px

Status Badge:
- Text: "Akan Datang" / "Berlangsung" / "Selesai"
- Color based on status: Orange/Green/Gray
- Font: 14px Medium
- Padding: 6px 16px
- Border-radius: 12px (pill)
- Display: Inline-block
- Margin-bottom: 24px

B. INFO GRID (2 kolom, responsive 1 kolom mobile):

Display: Grid 2 columns, gap 24px
Margin-bottom: 40px

Info Box (per item):
- Background: Light gray #F9F9F9
- Border-left: 4px solid Orange #FF6B35
- Padding: 20px
- Border-radius: 8px

Info Box Content:
1. Icon (top):
   - Size: 24px
   - Color: Orange
   - Margin-bottom: 8px

2. Label:
   - Font: 12px Medium
   - Color: Gray #6B7280
   - Text-transform: Uppercase
   - Letter-spacing: 0.5px
   - Margin-bottom: 8px

3. Value:
   - Font: 18px Bold (desktop), 16px Bold (mobile)
   - Color: Navy #1F3A5F
   - Line-height: 1.4

Info Items:
┌───────────────┬───────────────┐
│ 📅 Tanggal    │ 🕐 Waktu      │
│ 18 Okt 2026   │ 14:00 - 16:00 │
├───────────────┼───────────────┤
│ 📍 Lokasi     │ 👥 Kuota      │
│ Lapangan Kota │ 20 Orang      │
└───────────────┴───────────────┘

C. DESKRIPSI LENGKAP:

Section Title: "Deskripsi Kegiatan"
- Font: 20px Bold
- Color: Navy
- Margin-bottom: 16px
- Border-bottom: 2px solid #E0E0E0
- Padding-bottom: 8px

Content:
- Font: 16px Regular
- Color: Dark Gray #2C3E50
- Line-height: 1.8
- Margin-bottom: 32px
- Text: Long form content (2-4 paragraphs)

Example text:
"Kami mengadakan latihan rutin setiap minggu untuk meningkatkan keterampilan basket anggota. Latihan ini terbuka untuk semua level, dari pemula hingga mahir.

Kegiatan meliputi:
• Pemanasan dan stretching
• Drill teknik dasar (dribbling, shooting, passing)
• Scrimmage (pertandingan latihan)
• Cool down

Pastikan membawa:
✓ Sepatu basket
✓ Botol minum
✓ Handuk kecil
✓ Semangat!"

D. ACTION BUTTONS:

Display: Flex, gap 16px
Margin-top: 40px
Flex-wrap: Wrap (mobile: stack)

Button 1 - "Daftar Kegiatan":
- Background: Orange #FF6B35
- Color: White
- Padding: 14px 40px
- Border-radius: 8px
- Font: 16px Bold
- Icon: Checkmark atau plus (✓ atau +) sebelum text
- Shadow: 0 4px 12px rgba(255, 107, 53, 0.3)
- Hover: Background darker, scale 1.05
- Transition: 0.3s

Button 2 - "Bagikan":
- Background: Transparent
- Border: 2px solid Navy
- Color: Navy
- Padding: 14px 32px
- Border-radius: 8px
- Font: 16px Bold
- Icon: Share icon sebelum text
- Hover: Background Navy, color White

E. KEGIATAN TERKAIT (Optional bottom section):

Section Title: "Kegiatan Lainnya"
- Font: 24px Bold
- Color: Navy
- Text-align: Center
- Margin: 60px 0 32px

Grid: 3 kartu kegiatan horizontal (sama styling dengan halaman list)
- Desktop: 3 cards, Tablet: 2 cards, Mobile: 1 card

=== HALAMAN 4: PENGUMUMAN PUBLIK ===

Layout mirip dengan Kegiatan Publik, tapi dengan card design berbeda:

--- PAGE HEADER: Sama seperti Kegiatan Publik ---
Title: "Pengumuman"
Subtitle: "Informasi penting untuk anggota dan publik"

--- FILTER BAR ---
Search + Filter Priority (Semua | Penting | Biasa)

--- LIST PENGUMUMAN ---

Layout: Vertical stack (bukan grid)
- Display: Flex flex-direction column
- Gap: 16px
- Max-width: 900px
- Margin: Auto
- Padding: 40px 16px

Card Pengumuman (per item):
Background: White
Border-left: 5px solid (color based on priority: Red=Penting, Orange=Mendesak, Blue=Biasa)
Padding: 24px
Border-radius: 8px
Shadow: 0 2px 8px rgba(0, 0, 0, 0.06)
Transition: 0.3s
Hover: Shadow increase, slight scale

Card Content:
┌────────────────────────────────────┐
│ [🔴] Badge Priority    Tanggal     │
│                                    │
│ Judul Pengumuman (Bold, Large)    │
│                                    │
│ Preview isi pengumuman dengan      │
│ maksimal 2-3 baris, truncate...    │
│                                    │
│ [Selengkapnya ▶]                   │
└────────────────────────────────────┘

1. Priority Badge + Tanggal (Top row, flex space-between):
   Badge:
   - Text: "Penting" / "Mendesak" / "Biasa"
   - Font: 12px Medium
   - Padding: 4px 12px
   - Border-radius: 12px
   - Colors: Red bg/Green bg/Blue bg with lighter shade background
   
   Tanggal:
   - Font: 12px Regular
   - Color: Gray
   - Text: "18 Oktober 2026"

2. Judul:
   - Font: 20px Bold (desktop), 18px Bold (mobile)
   - Color: Navy #1F3A5F
   - Margin: 12px 0
   - Text: "Event Turnamen Basketball Antar Sekolah"

3. Preview:
   - Font: 14px Regular
   - Color: Gray #6B7280
   - Line-height: 1.6
   - Max-height: 3 lines dengan text ellipsis
   - Margin-bottom: 12px

4. Link:
   - Font: 14px Medium
   - Color: Navy
   - Text: "Selengkapnya ▶"
   - Hover: Color Orange, underline

--- PAGINATION: Sama seperti Kegiatan ---

=== HALAMAN 5: DETAIL PENGUMUMAN ===

Layout mirip Detail Kegiatan, tapi tanpa hero image besar:

--- BREADCRUMB ---
"Beranda > Pengumuman > Event Turnamen Basketball"

--- CONTENT CONTAINER ---

Background: White
Max-width: 800px
Margin: 40px auto
Padding: 48px (desktop), 24px (mobile)
Border-radius: 16px
Shadow: 0 4px 16px rgba(0, 0, 0, 0.08)

A. HEADER:
- Priority Badge (top)
- Judul Pengumuman (32px Bold Navy)
- Info row: 📅 Tanggal | 👤 Penulis (Admin)

B. CONTENT:
- Rich text content (formatted text dengan paragraphs, lists, bold, italic)
- Font: 16px Regular
- Line-height: 1.8
- Color: Dark gray

C. ATTACHMENTS (Optional):
- Section title: "Lampiran"
- File list dengan icon + filename + size
- Download button per file

D. BACK BUTTON:
- "◀ Kembali ke Pengumuman"
- Outline button, navy color

=== RESPONSIVE BEHAVIOR ===

Desktop (>1200px):
- Navbar: Full horizontal dengan semua items visible
- Hero container: 640px max-width
- Grid: 3 kolom untuk cards
- Sidebar: None (web publik tanpa sidebar)

Tablet (768px - 1199px):
- Navbar: Menu items masih visible, search bisa hidden
- Hero container: 90% width
- Grid: 2 kolom untuk cards
- Font sizes sedikit lebih kecil

Mobile (<768px):
- Navbar: Hamburger menu (full-screen overlay)
- Hero container: 95% width, padding 24px
- Grid: 1 kolom untuk cards
- Buttons: Full-width stack
- Font sizes scaled down
- Carousel height: 200px

=== INTERACTION & MICRO-ANIMATIONS ===

1. Scroll Animations:
   - Fade-in untuk cards saat scroll ke viewport (stagger delay)
   - Smooth scroll untuk anchor links

2. Hover Effects:
   - Buttons: Scale 1.05, shadow increase
   - Cards: Shadow increase, translateY(-4px)
   - Links: Color change, underline appear
   - Images: Slight zoom (scale 1.1) dengan overflow hidden

3. Transitions:
   - Global: 0.2s - 0.3s ease-in-out
   - Images: 0.5s ease
   - Carousel: 0.5s ease-in-out

4. Loading States:
   - Skeleton loaders untuk cards saat data fetching
   - Spinner untuk form submissions

5. Form Feedback:
   - Success: Green border + checkmark
   - Error: Red border + error message below input
   - Focus: Orange border dengan shadow glow

=== ACCESSIBILITY (a11y) ===

- Semantic HTML (header, nav, main, section, footer)
- ARIA labels untuk icons dan buttons
- Focus states visible (outline 2px orange)
- Keyboard navigation support
- Alt text untuk semua images
- Contrast ratio minimum 4.5:1 untuk text
- Skip to content link untuk screen readers

=== TECH STACK & LIBRARIES ===

Frontend:
- React 18+ dengan Next.js 14 (App Router)
- Tailwind CSS untuk styling
- Framer Motion untuk animations (optional)

Components:
- Lucide React atau Heroicons untuk icons
- Swiper.js atau Embla Carousel untuk image carousel
- React Hook Form untuk forms (jika ada contact form)
- Date-fns untuk date formatting

Image Optimization:
- Next.js Image component untuk lazy loading
- WebP format dengan fallback

Performance:
- Code splitting
- Lazy loading untuk images dan components
- SEO meta tags per page

=== OUTPUT YANG DIHARAPKAN ===

Buat design web publik SI-BASKET dengan:

1. **Landing Page** — Hero dengan carousel + sections kegiatan & pengumuman terbaru
2. **Kegiatan Publik** — List page dengan filter & pagination
3. **Detail Kegiatan** — Full info dengan CTA daftar
4. **Pengumuman Publik** — List vertical dengan priority badges
5. **Detail Pengumuman** — Full content dengan attachments
6. **Footer** — Lengkap dengan links & kontak

Semua halaman:
- Navbar yang konsisten (fixed top)
- Footer yang konsisten
- Fully responsive (desktop, tablet, mobile)
- Modern, clean, energetic basketball vibe
- Fast, accessible, SEO-friendly

Gunakan React components yang reusable dan maintainable.
Implementasikan dengan Tailwind CSS utility-first approach.
Pastikan performance optimal dengan lazy loading dan code splitting.
```

---

## CARA PAKAI

1. Copy seluruh prompt di atas (dari "Kamu adalah UI/UX designer..." hingga akhir)
2. Paste ke **v0.dev** atau **Claude Artifacts**
3. Generate → Tunggu hasilnya
4. Refine jika perlu

---

## FITUR YANG TERCAKUP

✅ Landing Page (Hero + Carousel + Sections)
✅ Navbar Publik (Fixed, responsive, dengan hamburger mobile)
✅ Halaman Kegiatan Publik (Grid cards + Filter + Pagination)
✅ Detail Kegiatan (Info lengkap + CTA Daftar)
✅ Halaman Pengumuman Publik (List vertical + Priority badges)
✅ Detail Pengumuman (Full content + Attachments)
✅ Footer (Links + Kontak + Social media)
✅ Responsive Design (Desktop, Tablet, Mobile)
✅ Hover Effects & Animations
✅ Accessibility Guidelines

**Prompt ini fokus 100% untuk WEB PUBLIK (tanpa dashboard/admin area)**
