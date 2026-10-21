# 🏀 SI-BASKET: PROMPT DESIGN DASHBOARD & ADMIN PAGES

**Khusus untuk halaman-halaman authenticated (setelah login)**

Copy-paste prompt ini ke v0.dev untuk membuat dashboard & admin pages SI-BASKET.

---

## PROMPT LENGKAP DASHBOARD (COPY LANGSUNG KE v0.dev)

```
Kamu adalah UI/UX designer profesional untuk aplikasi web internal enterprise.

Buat design lengkap **DASHBOARD SI-BASKET** (halaman-halaman setelah user login) dengan teknologi React + Next.js + Tailwind CSS.

=== APLIKASI OVERVIEW ===

**Nama:** SI-BASKET - Dashboard Manajemen Organisasi Basket
**Tujuan:** Platform internal untuk manage anggota, kegiatan, absensi, keuangan, dan pengumuman
**Target User:** Super Admin, Admin, Pembina, Member (role-based access)
**Device:** Desktop-first, responsive (tablet & mobile)
**Inspirasi Design:** Modern corporate dashboard (clean, professional, sporty basketball elements)

=== COLOR PALETTE ===

Primary: Navy Blue #1F3A5F (professional, sidebar, primary actions)
Secondary: Orange/Coral #FF6B35 (accent, highlights, CTA buttons)
Background: Light Gray #F5F5F5 (page background)
Cards: White #FFFFFF (content containers)
Text: Dark Gray #2C3E50 (body text)
Text Light: Gray #6B7280 (secondary text)
Neutral Gray: #9CA3AF (borders, dividers)
Success: Green #27AE60 (positive status)
Warning: Amber #F59E0B (pending/attention)
Danger: Red #EF4444 (error/delete)
Info: Blue #3B82F6 (information)
Overlay: rgba(0, 0, 0, 0.5) (modals, dropdowns)

=== TYPOGRAPHY ===

Font Family: Inter, Poppins, atau Montserrat (modern sans-serif)

Desktop:
- Page Title (H1): 28px Bold
- Section Title (H2): 20px Semi-bold
- Card Title (H3): 16px Bold
- Body Large: 16px Regular
- Body: 14px Regular
- Body Small: 12px Regular
- Caption: 11px Regular
- Label: 12px Medium

Mobile:
- Page Title: 24px Bold
- Section Title: 18px Semi-bold
- Card Title: 14px Bold
- Body: 13px Regular

Line Height: 1.5 untuk body text, 1.3 untuk headings

=== LAYOUT STRUKTUR ===

--- SIDEBAR NAVIGASI (Fixed Left) ---

Position: Fixed left, z-index 999
Width: 280px (desktop), collapsed 80px (desktop collapsed), hidden (mobile <768px)
Background: Navy Blue #1F3A5F
Height: 100vh
Border-right: 1px solid rgba(255, 255, 255, 0.1)
Overflow-y: Auto
Padding: 24px 16px

Sidebar Content:

A. LOGO SECTION (Top):
   Background: rgba(255, 107, 53, 0.1)
   Padding: 16px 12px
   Border-radius: 8px
   Margin-bottom: 32px
   
   Logo + Text: "SI-BASKET"
   - Display: Flex, gap 12px, align-items center
   - Logo: Basketball icon, size 28px, color Orange
   - Text: 18px Bold, color White
   - On collapsed: Only icon visible, centered
   
   Tooltip on hover (collapsed): "SI-BASKET"

B. MENU ITEMS:
   Display: Flex flex-direction column, gap 8px
   
   Menu Item (per navigasi):
   - Display: Flex, align-items center, gap 12px
   - Padding: 12px 16px
   - Border-radius: 8px
   - Font: 14px Regular
   - Color: rgba(255, 255, 255, 0.7) (default)
   - Cursor: Pointer
   - Transition: 0.2s
   
   Hover state:
   - Color: White
   - Background: rgba(255, 255, 255, 0.1)
   
   Active state:
   - Background: Orange #FF6B35
   - Color: White
   - Font: Semi-bold
   - Icon color: White
   
   Icons: 24px, color inherit
   
   Menu Items (Role-based visibility):
   
   **Super Admin & Admin:**
   🏠 Dashboard
   👥 Anggota
   📅 Kegiatan
   ✅ Absensi
   💰 Keuangan
   📢 Pengumuman
   ⚙️ Pengaturan
   
   **Pembina:**
   🏠 Dashboard
   📅 Kegiatan (read-only)
   ✅ Absensi
   💰 Keuangan (read-only)
   📢 Pengumuman (read-only)
   
   **Member:**
   🏠 Dashboard
   📅 Kegiatan
   ✅ Absensi Saya
   📢 Pengumuman
   
   C. DIVIDER:
      Border-top: 1px solid rgba(255, 255, 255, 0.1)
      Margin: 24px 0
   
   D. USER SECTION (Bottom):
      Display: Flex, align-items center, gap 12px
      Padding: 12px 16px
      Border-radius: 8px
      Background: rgba(255, 255, 255, 0.05)
      Margin-top: Auto
      
      User Avatar: 40px circular, background Orange with initials
      User Info (collapsed: hidden):
      - Name: 14px Bold, White
      - Role: 11px Regular, rgba(255, 255, 255, 0.6)
      
      Dropdown (on click):
      - "Edit Profil"
      - "Ubah Password"
      - "Logout"

--- TOP NAVBAR (Fixed Top) ---

Position: Fixed top, z-index 1000 (above sidebar)
Left: 280px (desktop), 0px (mobile <768px)
Right: 0
Background: White
Border-bottom: 1px solid #E5E7EB
Height: 72px
Padding: 0 24px
Display: Flex, align-items center, justify-content space-between
Shadow: 0 1px 3px rgba(0, 0, 0, 0.1)

Left Section:
- Hamburger menu (mobile): 3 lines icon, 24px, color Navy (hidden desktop)
- Page breadcrumb (desktop): "Dashboard > Anggota" — 13px Regular, gray
  * Active page: Bold Navy

Right Section:
- Search input (desktop only):
  * Width: 280px
  * Placeholder: "Cari anggota, kegiatan..."
  * Border: 1px solid #E5E7EB
  * Border-radius: 8px
  * Padding: 10px 16px
  * Font: 13px Regular
  * Icon: Search left, gray color
  * Focus: Border Orange, shadow 0 0 0 3px rgba(255, 107, 53, 0.1)

- Notifications icon: 20px, Bell icon, gray (relative position with red dot for unread)
  * Red dot: 8px circle, top-right, color Red #EF4444
  * On click: Dropdown menu dengan 5 recent notifications
  
- Divider: Vertical line, 1px, color #E5E7EB

- User menu dropdown:
  * Avatar: 36px circular, background Orange with initials
  * On click: Dropdown menu
    - "👤 Edit Profil"
    - "🔑 Ubah Password"
    - "🚪 Logout"

--- MAIN CONTENT AREA ---

Position: Fixed left (sidebar width + navbar height)
Background: Light Gray #F5F5F5
Min-height: 100vh
Padding: 32px

Desktop: margin-left 280px, margin-top 72px
Mobile: full-width (sidebar hidden), margin-top 64px

=== HALAMAN 1: DASHBOARD HOME ===

--- HEADER SECTION ---

Title: "Dashboard"
- Font: 28px Bold, Navy
- Margin-bottom: 8px

Subtitle: "Selamat datang kembali, Nabil!" (dynamic nama user)
- Font: 14px Regular, Gray
- Margin-bottom: 24px

Last updated: "Last updated: 2 menit yang lalu"
- Font: 11px Regular, Gray, right-aligned

--- STATS CARDS (Grid) ---

Display: Grid 4 columns (desktop), 2 (tablet), 1 (mobile)
Gap: 20px
Margin-bottom: 32px

Card Stats (per metrik):
Background: White
Border-radius: 12px
Padding: 24px
Shadow: 0 1px 3px rgba(0, 0, 0, 0.05)
Border: 1px solid #E5E7EB
Transition: 0.3s

Hover: Shadow increase, border orange

Card Content:
┌──────────────────────────┐
│ [Icon] Label    ▲ +5%    │  ← trend indicator
│                          │
│ 245 Anggota              │  ← big number
│                          │
│ vs 230 bulan lalu        │  ← comparison
└──────────────────────────┘

1. Icon (top-left):
   - Size: 36px
   - Background: Colored pill (orange for growth, green for success, blue for info)
   - Color: White
   - Rounded: 50%

2. Label (top-right):
   - Font: 12px Medium
   - Color: Gray
   - Uppercase

3. Trend indicator (top-right):
   - Display: Flex, align-items center, gap 4px
   - Green arrow ▲ or Red arrow ▼
   - Number: 12px Bold, color green or red
   - Font: "+5%" atau "-2%"

4. Main number (center):
   - Font: 32px Bold
   - Color: Navy
   - Text: "245"

5. Comparison (bottom):
   - Font: 13px Regular
   - Color: Gray
   - Text: "vs 230 bulan lalu"

Stats Cards (examples):
Card 1: Total Anggota (Orange icon, 245, +5%)
Card 2: Kegiatan Aktif (Green icon, 12, +2%)
Card 3: Tingkat Kehadiran (Blue icon, 87%, +3%)
Card 4: Saldo Kas (Purple icon, Rp 5.2M, +12%)

--- SECTION: KEGIATAN MENDATANG (Horizontal cards) ---

Background: White
Border-radius: 12px
Padding: 24px
Shadow: 0 1px 3px rgba(0, 0, 0, 0.05)
Margin-bottom: 32px

Header:
- Title: "Kegiatan Mendatang"
  * Font: 18px Bold, Navy
  * Margin-bottom: 16px
- Link: "Lihat semua ▶" (top-right)
  * Font: 13px Medium, Navy
  * Hover: Color Orange

Grid Layout: Scroll horizontal (5 cards visible)
Card Width: 300px (fixed)
Gap: 16px

Card Kegiatan (horizontal):
Background: Light gray #F9F9F9
Border: 1px solid #E5E7EB
Border-radius: 8px
Padding: 16px
Display: Flex, flex-direction column, gap 12px

Content:
1. Badge Tanggal (top):
   - Background: Orange pill
   - Text: "18 Okt | 14:00 - 16:00"
   - Font: 11px Medium, Orange

2. Nama Kegiatan:
   - Font: 14px Bold, Navy
   - Line-height: 1.3

3. Kuota:
   - Display: Flex, align-items center, gap 8px
   - Icon: 👥 (16px)
   - Text: "20 / 25 orang"
   - Font: 12px Regular, Gray

4. Progress Bar (visual indicator):
   - Width: 100%
   - Height: 6px
   - Background: #E5E7EB
   - Fill: Orange, width 80%
   - Border-radius: 3px

5. Button:
   - Text: "Lihat Detail ▶"
   - Font: 12px Medium, Navy
   - Background: Transparent
   - Hover: Color Orange

--- SECTION: AKTIVITAS TERBARU (Activity log) ---

Background: White
Border-radius: 12px
Padding: 24px
Shadow: 0 1px 3px rgba(0, 0, 0, 0.05)

Header:
- Title: "Aktivitas Terbaru"
  * Font: 18px Bold, Navy

Timeline/List:
Display: Flex flex-direction column
Gap: 16px (between items)

Activity Item:
Display: Flex, gap 16px
Padding: 12px 0
Border-bottom: 1px solid #E5E7EB (except last item)

1. Icon/Avatar (left):
   - Size: 36px circular
   - Background: Colored based on activity type
   - Icon atau initials

2. Content (right):
   - Activity text: "Nabil mendaftar ke kegiatan Latihan Rutin Basket"
     * Font: 13px Regular, Navy
   - Timestamp: "2 jam yang lalu"
     * Font: 11px Regular, Gray
     * Position: below activity text

=== HALAMAN 2: MANAJEMEN ANGGOTA ===

--- PAGE HEADER ---

Title: "Anggota"
Subtitle: "Kelola daftar anggota organisasi"
Button: "+ Tambah Anggota" (orange CTA button)
- Font: 14px Bold
- Padding: 10px 20px
- Background: Orange
- Color: White
- Border-radius: 6px
- Hover: darker orange, scale 1.05

Position: Right side (Breadcrumb on left)

--- FILTER & SEARCH BAR ---

Background: White
Padding: 16px 24px
Border-bottom: 1px solid #E5E7EB
Display: Flex, gap 16px, align-items center, flex-wrap wrap

1. Search Input:
   - Width: 300px (desktop), full-width (mobile)
   - Placeholder: "Cari nama, email, nomor identitas..."
   - Icon: Search (left)
   - Border: 1px solid #DDD
   - Padding: 10px 16px
   - Border-radius: 6px

2. Filter Dropdown (Status):
   - Label: "Status:"
   - Options: Semua | Aktif | Inactive | Pending
   - Width: 150px
   - Border: 1px solid #DDD
   - Padding: 8px 12px
   - Border-radius: 6px

3. Filter Dropdown (Role):
   - Label: "Role:"
   - Options: Semua | Admin | Pembina | Member
   - Width: 150px

4. Sort Dropdown:
   - Label: "Urutkan:"
   - Options: Terbaru | Nama A-Z | Status
   - Width: 150px

5. Icons (right):
   - Download Excel icon (gray, hover orange)
   - Filter icon (gray, hover orange)

--- TABLE ANGGOTA ---

Background: White
Border: 1px solid #E5E7EB
Border-radius: 8px
Overflow: Hidden
Margin: 24px 24px
Shadow: 0 1px 3px rgba(0, 0, 0, 0.05)

Table Header:
- Background: Light gray #F9F9F9
- Border-bottom: 1px solid #E5E7EB
- Padding: 16px 24px
- Font: 12px Bold, Navy
- Uppercase

Table Columns:
1. Checkbox (select all) — 20px
2. Nama — 30% width
3. Email — 25% width
4. Role — 15% width
5. Status — 12% width (badge)
6. Actions — 18% width (3 icons)

Table Rows:
- Padding: 16px 24px
- Border-bottom: 1px solid #E5E7EB (except last)
- Font: 13px Regular, Dark gray
- Hover: Background light gray

Row Content:

1. Checkbox: 
   - 20px square checkbox
   - Border: 1px solid #DDD
   - Checked: Background Orange, checkmark white

2. Nama:
   - Font: 13px Bold, Navy
   - Avatar icon (20px) sebelum nama, gap 8px

3. Email:
   - Font: 13px Regular, Gray
   - Email clickable (hover: color orange)

4. Role:
   - Badge pill style
   - Admin: Navy background, white text
   - Pembina: Purple background, white text
   - Member: Blue background, white text

5. Status:
   - Badge pill style
   - Aktif: Green background, white text
   - Inactive: Gray background, white text
   - Pending: Amber background, white text

6. Actions:
   - 3 icons di row: View | Edit | Delete
   - Size: 16px
   - Color: Gray
   - Hover: Color Orange (View), Amber (Edit), Red (Delete)
   - Icons: Eye | Pencil | Trash

--- PAGINATION ---

Position: Below table
Display: Flex, justify-content space-between, align-items center
Padding: 16px 24px
Border-top: 1px solid #E5E7EB

Left: "Menampilkan 1-10 dari 245 anggota"
- Font: 13px Regular, Gray

Center: Page buttons
- ◀ [1] [2] [3] ... [25] ▶
- Each button: 32px square
- Border: 1px solid #DDD
- Border-radius: 4px
- Font: 12px
- Hover: Border Orange
- Active: Background Orange, color White

Right: "Per halaman:" dropdown
- Options: 10 | 25 | 50 | 100
- Default: 10

--- MODAL: ADD / EDIT ANGGOTA ---

Background: White
Border-radius: 12px
Width: 500px (desktop), 90% (mobile)
Padding: 32px
Shadow: 0 10px 40px rgba(0, 0, 0, 0.2)
Backdrop: rgba(0, 0, 0, 0.5)

Header:
- Title: "Tambah Anggota" atau "Edit Anggota"
  * Font: 18px Bold, Navy
- Close button (X): top-right, 24px, gray (hover: red)

Form Fields (vertical stack, gap 20px):

1. Nama Lengkap:
   - Label: "Nama Lengkap *"
   - Font: 12px Medium
   - Input: 100% width, border 1px #DDD, padding 10px 12px
   - Placeholder: "Masukkan nama..."
   - Focus: Border Orange, shadow glow

2. Email:
   - Similar styling
   - Placeholder: "contoh@email.com"

3. Nomor Identitas:
   - Similar styling
   - Help text: "NIM, NIK, atau ID lainnya"
   - Font: 11px Regular, Gray

4. Nomor Telepon:
   - Similar styling
   - Placeholder: "+62 812..."

5. Alamat:
   - Textarea: 100% width, height 120px
   - Border: 1px solid #DDD
   - Padding: 10px 12px
   - Resize: Vertical only

6. Role (dropdown):
   - Label: "Role *"
   - Options: Member | Pembina | Admin
   - Border: 1px solid #DDD

7. Status (radio buttons):
   - Label: "Status"
   - Options: ⭕ Aktif | ⭕ Inactive
   - Gap: 24px

8. Validasi/Error:
   - If error: Border red, error message below
   - Font: 11px Regular, red
   - Icon: ⚠️

Buttons (bottom):
- Display: Flex, gap 12px, justify-content flex-end
- "Batal" (outline navy button, width 100px)
- "Simpan" (solid orange button, width 100px)

=== HALAMAN 3: MANAJEMEN KEGIATAN ===

--- PAGE HEADER ---

Title: "Kegiatan"
Subtitle: "Kelola daftar kegiatan organisasi"
Button: "+ Buat Kegiatan" (orange CTA)

--- FILTER & SEARCH ---

Similar ke Anggota, tapi dengan filter:
- Search: "Cari nama kegiatan..."
- Status: Semua | Akan Datang | Berlangsung | Selesai
- Sort: Terbaru | Nama | Status

--- VIEW OPTIONS (top-right) ---

Display: Flex, gap 8px
- List view icon (active): Blue background
- Grid view icon: Gray

--- TABLE KEGIATAN (List view) atau GRID (Grid view) ---

**List View (default):**

Table Structure:
1. Checkbox
2. Nama Kegiatan — 25% (with icon 📅)
3. Tanggal — 20% (format: "18 Okt 2026")
4. Waktu — 12% (format: "14:00 - 16:00")
5. Lokasi — 20%
6. Kuota — 12% (format: "20/25")
7. Status — 11% (badge)
8. Actions — 15%

Row Hover: Slight background change, actions visible (edit, delete, view details)

**Grid View:**

Grid Layout: 3 columns (desktop), 2 (tablet), 1 (mobile)
Gap: 20px
Cards: 300px width

Card Kegiatan:
- Image: 300px × 200px, object-fit cover, aspect 3:2
- Content area: Padding 16px
  * Tanggal badge: Orange pill (top-left, absolute)
  * Nama: 14px Bold, Navy
  * Lokasi: 12px Regular, Gray, with icon
  * Kuota bar: Progress bar visual
  * Status badge: Bottom-right
  * Button: "Edit" & "Delete" (overlay on hover atau bottom)

--- MODAL: ADD / EDIT KEGIATAN ---

Similar structure to Anggota, width 600px (wider for more fields)

Form Fields:
1. Nama Kegiatan *
2. Deskripsi (textarea)
3. Tanggal *
4. Waktu Mulai * (time picker)
5. Waktu Selesai * (time picker)
6. Lokasi *
7. Kuota Peserta * (number input)
8. Foto Kegiatan (file uploader)
   - Show preview of uploaded image
   - Max file: 5MB
   - Formats: JPG, PNG
9. Status (radio: Aktif | Inactive)
10. Keterangan (textarea, optional)

=== HALAMAN 4: ABSENSI ===

--- PAGE HEADER ---

Title: "Absensi"
Subtitle: "Kelola kehadiran anggota"
Filter: Kegiatan (dropdown) — required to show data

Button: "+ Input Absensi Manual" (conditional: Admin/Pembina only)

--- KEGIATAN SELECTOR ---

Display: Highlighted selector card
Background: Orange with 10% opacity
Padding: 20px
Border-radius: 8px
Border: 2px dashed Orange

Content:
- Label: "Pilih Kegiatan:"
  * Font: 12px Medium, Navy
- Dropdown: "Latihan Rutin Basket" (large button style)
  * Font: 14px Bold
  * Width: 100%
  * Padding: 12px 16px
  * On click: Modal dengan list kegiatan

Info text (below):
- "Menampilkan absensi untuk Latihan Rutin Basket (18 Okt 2026, 14:00 - 16:00)"
- Font: 12px Regular, Gray

--- STATS SUMMARY (after kegiatan selection) ---

Display: Grid 3 columns (desktop), 2 (tablet), 1 (mobile)
Gap: 16px
Padding: 20px 0

Card Stats (small):
1. Hadir: 20 orang (Green pill icon)
2. Tidak Hadir: 3 orang (Red pill icon)
3. Izin: 2 orang (Amber pill icon)

Each card:
- Background: Light gray
- Border-left: 4px colored
- Padding: 16px
- Display: Flex, gap 12px
  * Icon: 32px circle, colored
  * Content:
    - Label: 11px Regular, Gray (uppercase)
    - Number: 24px Bold, Navy

--- TABEL ABSENSI ---

Table Structure:
1. Checkbox
2. Nama Anggota — 25% (with avatar)
3. Status — 15% (colored badge: Hadir/Tidak Hadir/Izin)
4. Keterangan — 35%
5. Waktu Input — 15% (timestamp)
6. Actions — 10%

Status Badge styling:
- Hadir: Green background, white text
- Tidak Hadir: Red background, white text
- Izin: Amber background, white text

Row click: Open detail/edit modal

--- MODAL: INPUT ABSENSI ---

Background: White
Width: 400px
Padding: 32px

Form:
1. Nama Anggota (dropdown atau search):
   - Placeholder: "Pilih anggota..."
   - Show all members dari selected kegiatan

2. Status (radio buttons):
   - ⭕ Hadir
   - ⭕ Tidak Hadir
   - ⭕ Izin

3. Keterangan (textarea):
   - Placeholder: "Alasan ketidakhadiran (opsional)..."
   - Height: 100px

4. Buttons:
   - "Batal" (outline)
   - "Simpan" (solid orange)

--- EXPORT BUTTON ---

Position: Top-right (after kegiatan selector)
Button: "📥 Export Excel"
- Font: 13px Medium
- Padding: 10px 16px
- Background: White
- Border: 1px solid #DDD
- Color: Navy
- Icon: 16px, left side
- Hover: Border Orange, background light orange

=== HALAMAN 5: KEUANGAN ===

--- PAGE HEADER ---

Title: "Keuangan"
Subtitle: "Kelola transaksi kas organisasi"

--- FILTER & SEARCH ---

Background: White
Padding: 20px 24px
Display: Flex, gap 16px, flex-wrap wrap

1. Search: "Cari deskripsi, referensi..."
2. Filter Jenis:
   - Options: Semua | Pemasukan | Pengeluaran
3. Filter Tanggal Range:
   - From date picker (calendar icon)
   - To date picker
4. Sort: Terbaru | Terlama | Jumlah

--- STATS SUMMARY ---

Display: Grid 4 columns (desktop), 2 (tablet), 1 (mobile)
Gap: 20px

Card 1 - Saldo Awal:
- Icon: 💰 (purple)
- Number: "Rp 3.5M"
- Subtitle: "Saldo awal bulan"

Card 2 - Pemasukan:
- Icon: 📈 (green)
- Number: "Rp 2.1M"
- Subtitle: "Bulan ini"

Card 3 - Pengeluaran:
- Icon: 📉 (red)
- Number: "Rp 1.8M"
- Subtitle: "Bulan ini"

Card 4 - Saldo Akhir:
- Icon: 💎 (orange, highlighted)
- Number: "Rp 3.8M" (bold, large 28px)
- Subtitle: "Saldo saat ini"

--- TABEL TRANSAKSI ===

Table Structure:
1. Checkbox
2. Tanggal — 12%
3. Deskripsi — 30%
4. Jenis — 10% (badge)
5. Jumlah — 15% (right-aligned)
6. Referensi — 18%
7. Catatan — 10%
8. Actions — 5%

Cell Styling:

- Tanggal: "18 Okt 2026" (13px Regular)
- Deskripsi: Bold navy (clickable untuk detail)
- Jenis Badge:
  * Pemasukan: Green pill "Masuk"
  * Pengeluaran: Red pill "Keluar"
- Jumlah (right-aligned, bold):
  * Pemasukan: Green text "+ Rp 500.000"
  * Pengeluaran: Red text "- Rp 250.000"
- Referensi: Gray text (invoice/receipt number)
- Catatan: Italic gray (keterangan singkat)

--- MODAL: ADD / EDIT TRANSAKSI ---

Width: 500px
Padding: 32px

Form Fields:
1. Tanggal * (date picker)
2. Jenis * (radio: Pemasukan | Pengeluaran)
3. Deskripsi * (text input, 100%)
4. Jumlah * (number input dengan format Rupiah)
   - Show preview: "Rp 500.000"
5. Referensi (text input, optional)
   - Help: "Invoice, receipt number, dll"
6. Catatan (textarea, optional)

Buttons: "Batal" | "Simpan"

--- BUTTON: EXPORT EXCEL ---

Position: Top-right
Styling: Sama dengan halaman Absensi

=== HALAMAN 6: PENGUMUMAN ===

--- PAGE HEADER ---

Title: "Pengumuman"
Subtitle: "Kelola pengumuman organisasi"
Button: "+ Buat Pengumuman" (orange CTA)

--- FILTER & SEARCH ---

1. Search: "Cari judul pengumuman..."
2. Filter Status:
   - Options: Semua | Draft | Published | Archived
3. Filter Priority:
   - Options: Semua | Penting | Biasa
4. Sort: Terbaru | Terlama | Judul

--- LIST PENGUMUMAN ---

Background: White
Padding: 24px
Display: Flex flex-direction column, gap 16px

Pengumuman Item (card):
- Background: White
- Border: 1px solid #E5E7EB
- Border-left: 5px colored (based on priority)
- Padding: 20px
- Border-radius: 8px
- Hover: Shadow increase, cursor pointer
- Transition: 0.2s

Card Layout:
┌─────────────────────────────────────┐
│ [Badge] Tanggal | Status  | ...     │ ← Top row
│                                     │
│ Judul Pengumuman (Bold, Large)      │
│                                     │
│ Preview isi maksimal 2 baris        │
│ dengan text ellipsis...             │
│                                     │
│ [Edit] [Delete] [Archive] [▶]      │ ← Buttons
└─────────────────────────────────────┘

Card Content:

1. Top Row (Flex space-between):
   Left:
   - Priority Badge (11px Medium pill):
     * Penting: Red background
     * Biasa: Blue background
   - Tanggal: 12px Regular, Gray
   
   Right:
   - Status Badge (11px Medium pill):
     * Published: Green
     * Draft: Gray
     * Archived: Gray
   - 3-dot menu icon (more options)

2. Judul:
   - Font: 16px Bold, Navy
   - Margin: 12px 0
   - Clickable (hover: color orange)

3. Preview:
   - Font: 13px Regular, Gray
   - Line-height: 1.6
   - Max-height: 2 lines dengan ellipsis
   - Margin-bottom: 12px

4. Bottom Row (Flex space-between):
   Left:
   - Info: "Dibuat oleh Admin • 18 Okt 2026"
   - Font: 11px Regular, Gray
   
   Right:
   - Buttons:
     * "Baca" link (blue)
     * "Edit" icon (gray, hover orange)
     * "Delete" icon (gray, hover red)

--- MODAL: ADD / EDIT PENGUMUMAN ---

Width: 700px (wider untuk editor)
Padding: 32px
Max-height: 90vh
Scroll-y: Auto

Form Fields:

1. Judul * (text input, 100%)
   - Font: 14px
   - Placeholder: "Judul pengumuman..."

2. Isi Konten * (rich text editor)
   - Height: 300px
   - Toolbar: Bold | Italic | Underline | Heading | Link | List
   - Placeholder: "Tulis isi pengumuman di sini..."
   - Show formatting guide

3. Priority * (radio):
   - ⭕ Penting (Red)
   - ⭕ Biasa (Blue)

4. Lampiran (file uploader):
   - "Drag & drop file atau klik untuk browse"
   - Max: 3 files
   - Max size: 10MB per file
   - Show uploaded files dengan delete icon

5. Status (radio):
   - ⭕ Draft (save as draft, visible to creator only)
   - ⭕ Published (immediately visible to all)

Buttons:
- "Batal" (outline)
- "Simpan Draft" (secondary)
- "Publikasikan" (solid orange, prominent)

=== HALAMAN 7: PENGATURAN ===

--- PAGE HEADER ---

Title: "Pengaturan"
Subtitle: "Kelola preferensi dan konfigurasi sistem"

--- SETTINGS TABS (Left sidebar navigation) ---

Display: Vertical menu (like accordion)
Background: Light gray
Width: 240px (desktop), collapsed mobile

Tabs:
1. ⚙️ Profil Organisasi
2. 👥 Manajemen Pengguna
3. 🔐 Keamanan & Backup
4. 🎨 Tema & Tampilan
5. 📧 Notifikasi
6. 📋 Audit Log

Active tab: Orange background, white text
Hover: Background light orange

--- CONTENT AREA (Right side) ---

Width: Remaining space
Background: White

--- TAB 1: PROFIL ORGANISASI ---

Card 1 - Informasi Dasar:
- Background: White
- Border: 1px solid #E5E7EB
- Padding: 24px
- Border-radius: 8px
- Margin-bottom: 24px

Fields:
1. Nama Organisasi: "Organisasi Basket ABC"
2. Email: "admin@sibasket.local"
3. Telepon: "+62 812 3456 7890"
4. Alamat: "Jl. Merdeka No.5, Kota"
5. Website: "https://sibasket.local"

Each field:
- Label: 12px Medium, Navy
- Input: 100% width, border 1px #DDD, padding 10px 12px
- Focus: Border orange

Button at bottom:
- "Simpan Perubahan" (orange, right-aligned)

Card 2 - Logo & Branding:
- Similar card structure
- File uploader untuk logo
- Show preview: 200px × 200px
- Recommended: 1:1 ratio, min 200px
- Button: "Ganti Logo"

--- TAB 2: MANAJEMEN PENGGUNA ---

Card - List Pengguna:
- Same as Anggota table, but simpler
- Columns: Nama | Email | Role | Status | Actions
- Only Admins dapat create/edit/delete users

Buttons:
- "Buat Pengguna" (orange, top-right)

Modal untuk add/edit user:
- Nama
- Email (unique validation)
- Password (auto-generated, show option to customize)
- Confirm password
- Role (dropdown)
- Status (radio)

--- TAB 3: KEAMANAN & BACKUP ---

Card 1 - Backup Database:
- Teks: "Backup database organisasi secara berkala"
- Button: "Buat Backup Sekarang"
- Last backup: "18 Okt 2026, 14:30 WIB"
- List recent backups dengan download option

Card 2 - Reset Data:
- Warning badge (amber): "Hati-hati! Action ini tidak dapat dibatalkan"
- Teks: "Hapus semua data organisasi (kecuali user)"
- Button: "Reset Data" (red, danger style)
- Confirmation: Modal dengan warning + input field "Ketik RESET untuk konfirmasi"

--- TAB 4: TEMA & TAMPILAN ---

Card 1 - Theme:
- Pilihan: ⭕ Light (default) | ⭕ Dark | ⭕ Auto (system)
- Show preview: Light/Dark version

Card 2 - Bahasa:
- Dropdown: Indonesian | English
- (Future: support untuk multiple languages)

Card 3 - Warna Aksen:
- Radio buttons dengan warna:
  * Navy (default)
  * Blue
  * Purple
  * Green
- Show preview dengan 3 tombol berwarna

--- TAB 5: NOTIFIKASI ---

Card - Email Notifications:
- Checkbox list:
  ☑️ Notifikasi kegiatan baru
  ☑️ Laporan kehadiran harian
  ☑️ Ringkasan keuangan mingguan
  ☑️ Pengumuman penting
- Button: "Simpan Preferensi"

--- TAB 6: AUDIT LOG ---

Card - Activity Log:
- Table dengan columns:
  * Tanggal | User | Aksi | Resource | Detail | Timestamp
- Pagination: 50 per page
- Filter: User (dropdown), Jenis aksi (dropdown), Tanggal range
- Export: "Export Log (.csv)" button

=== MODALS & DIALOGS ===

--- CONFIRMATION DIALOG ---

For destructive actions (delete, reset):

Background: White
Width: 400px
Padding: 32px
Border-radius: 12px
Shadow: 0 10px 40px rgba(0, 0, 0, 0.3)

Content:
- Icon: ⚠️ (large, red, 48px) centered at top
- Title: "Hapus Anggota?"
  * Font: 16px Bold, Navy
  * Text-align: Center
- Message: "Action ini tidak dapat dibatalkan. Anggota Nabil akan dihapus dari sistem."
  * Font: 13px Regular, Gray
  * Text-align: Center
  * Margin: 16px 0 32px

Buttons (bottom):
- "Batal" (outline, left)
- "Hapus" (danger red, right)

--- SUCCESS TOAST ---

Position: Top-right
Background: Green #27AE60
Color: White
Padding: 16px 20px
Border-radius: 6px
Shadow: 0 4px 12px rgba(0, 0, 0, 0.2)

Icon: ✓ (left)
Message: "Anggota berhasil dihapus"
Font: 13px Regular

Auto-dismiss: 3 seconds
Animation: Fade-in (0.2s), Fade-out (0.3s)

--- ERROR TOAST ---

Similar to success, but:
- Background: Red
- Icon: ✕
- Message: "Gagal menyimpan data. Silakan coba lagi."

=== RESPONSIVE BEHAVIOR ===

Desktop (>1200px):
- Sidebar: 280px fixed, always visible
- Navbar: Full width (accounting for sidebar)
- Content: Full width
- Tables: Horizontal scroll if needed
- Modals: 500px-700px width

Tablet (768px - 1199px):
- Sidebar: 240px fixed atau auto-collapse
- Navbar: Hamburger toggle untuk sidebar
- Content: 100% width
- Tables: Horizontal scroll
- Modals: 90% width

Mobile (<768px):
- Sidebar: Hidden, slide-out on hamburger click (full-width overlay)
- Navbar: 64px height, hamburger + title
- Content: Full width, padding 16px
- Tables: Horizontal scroll, smaller font
- Modals: Full-width dengan padding 16px
- Cards: Stack vertical, 100% width
- Buttons: Full-width stack pada mobile

=== INTERACTION & ANIMATIONS ===

Transitions: 0.2s - 0.3s ease-in-out (global)

Hover Effects:
- Buttons: Scale 1.05, shadow increase
- Rows: Slight background change
- Cards: Shadow increase, translateY(-2px)
- Links: Color change to orange, underline appear

Loading States:
- Skeleton loaders untuk tables
- Spinner untuk form submission
- Progress bar untuk file upload

Form Validation:
- Real-time validation (optional)
- Error display inline (below field)
- Success checkmark pada valid field

Keyboard Navigation:
- Tab untuk navigate elements
- Enter untuk submit
- Escape untuk close modal

=== ACCESSIBILITY (a11y) ===

- Semantic HTML (header, nav, main, section, footer)
- ARIA labels untuk icons dan buttons
- Focus states visible (outline 2px orange)
- Keyboard navigation support
- Alt text untuk semua images
- Contrast ratio minimum 4.5:1
- Form labels associated dengan inputs (for= attribute)
- Error messages linked to inputs (aria-describedby)

=== TECH STACK & LIBRARIES ===

Frontend:
- React 18+ dengan Next.js 14 (App Router)
- Tailwind CSS untuk styling
- Shadcn/ui untuk components (optional)

Components:
- Lucide React untuk icons
- React Table untuk tables dengan sorting/filtering
- React Hook Form untuk forms
- Date-fns atau Day.js untuk date handling
- React Toastify untuk notifications

State Management:
- Context API atau Zustand
- SWR atau React Query untuk data fetching

Performance:
- Code splitting
- Lazy loading components
- Image optimization

=== OUTPUT YANG DIHARAPKAN ===

Buat design dashboard & admin pages SI-BASKET dengan:

1. **Dashboard Home** — Stats cards, upcoming events, activity log
2. **Manajemen Anggota** — Table, filter, crud operations
3. **Manajemen Kegiatan** — List/grid view, filters, add/edit modal
4. **Absensi** — Kegiatan selector, attendance table, manual input
5. **Keuangan** — Transaction stats, transaction table, add/edit modal
6. **Pengumuman** — List dengan priority, add/edit dengan rich editor
7. **Pengaturan** — Multi-tab settings (profil, user, security, theme, notifications, audit log)

Semua halaman:
- Sidebar navigasi yang konsisten (fixed left)
- Top navbar (fixed top)
- Responsive di semua breakpoints
- Modal untuk add/edit operations
- Confirmation dialogs untuk destructive actions
- Toast notifications untuk feedback
- Fully accessible (WCAG compliance)

Gunakan React components yang reusable.
Implementasikan dengan Tailwind CSS.
Pastikan performance optimal dengan lazy loading dan code splitting.
```

---

## CARA PAKAI

1. Copy seluruh prompt di atas (dari "Kamu adalah UI/UX designer..." hingga akhir)
2. Paste ke **v0.dev** atau **Claude Artifacts**
3. Generate → Tunggu hasilnya
4. Refine dengan: "Tambahin role-based visibility di sidebar untuk Pembina dan Member" atau feedback lain

---

## FITUR YANG TERCAKUP

✅ Dashboard Home (Stats, upcoming events, activity log)
✅ Sidebar navigasi (role-based menu visibility)
✅ Top navbar (breadcrumb, search, notifications, user menu)
✅ Manajemen Anggota (CRUD table dengan filter)
✅ Manajemen Kegiatan (List & grid view dengan filter)
✅ Absensi (Kegiatan selector, attendance table, manual input modal)
✅ Keuangan (Transaction stats, table dengan filter)
✅ Pengumuman (Vertical list dengan priority badges, rich editor)
✅ Pengaturan (Multi-tab: profil, users, security, theme, notifications, audit)
✅ Modals & Dialogs (Add/edit, confirmation, success/error toasts)
✅ Responsive Design (Desktop, Tablet, Mobile)
✅ Role-based Access (Super Admin, Admin, Pembina, Member)
✅ Hover Effects & Animations
✅ Accessibility Guidelines

**Prompt ini fokus 100% untuk DASHBOARD/ADMIN (authenticated area)**
**Untuk web publik, lihat file terpisah: `PROMPT-DESAIN-WEB-PUBLIK-SIBASKET.md`**
