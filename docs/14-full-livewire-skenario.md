# 14. Full Livewire Skenario & File Structure

[← Kembali ke index](./00-README.md)

> **Deskripsi:** Arsitektur Full Livewire, file structure, dan breakdown teknis implementation.
> **Status:** Reference untuk implementation
> **Lihat juga:** `13-full-livewire-decision.md` untuk decision & analysis

---

## 1. Architecture — Full Livewire (No Filament)

```
┌─────────────────────────────────────────────┐
│  SIBASKET - Full Livewire (No Filament)     │
├─────────────────────────────────────────────┤
│                                             │
│  https://sibasket.com/                      │
│  ├─ / (Halaman Publik - Blade)              │
│  │   ├─ Profil organisasi                   │
│  │   ├─ Jadwal kegiatan                     │
│  │   └─ Pengumuman                          │
│  │                                          │
│  ├─ /auth/login (Auth - Blade)              │
│  │   └─ Login form integrated (all roles)   │
│  │                                          │
│  ├─ /dashboard (Livewire - Auth Required)   │
│  │   ├─ Admin Dashboard                     │
│  │   │   ├─ Anggota (Livewire table)        │
│  │   │   ├─ Kegiatan (Livewire table)       │
│  │   │   ├─ Absensi (Livewire form + table) │
│  │   │   ├─ Keuangan (Livewire table)       │
│  │   │   └─ Pengumuman (Livewire CRUD)      │
│  │   │                                      │
│  │   └─ Member Dashboard (view-only)        │
│  │       ├─ Riwayat absensi pribadi         │
│  │       ├─ Pembayaran kas pribadi          │
│  │       └─ Kegiatan yang terdaftar         │
│  │                                          │
│  └─ /admin (Config - optional)              │
│      └─ Management & audit logs             │
│                                             │
└─────────────────────────────────────────────┘

TECH STACK:
├─ Backend: Laravel 11/12
├─ Frontend: Blade + Livewire 3
├─ CSS: Tailwind CSS
├─ Database: MySQL + Triggers/Functions
├─ Auth: Laravel Breeze + Spatie Laravel-Permission
└─ Deployment: [Hosting pilihan]
```

---

## 2. File Structure — Full Livewire Setup

```
app/
├─ Livewire/
│  ├─ AnggotaTable.php              (list, search, filter, paginate)
│  ├─ AnggotaForm.php               (create/edit dengan validation)
│  ├─ KegiatanTable.php
│  ├─ KegiatanForm.php
│  ├─ PendaftaranKegiatanTable.php
│  ├─ PendaftaranKegiatanForm.php
│  ├─ AbsensiTable.php
│  ├─ AbsensiForm.php
│  ├─ TransaksiKasTable.php
│  ├─ TransaksiKasForm.php
│  ├─ PengumumanTable.php
│  ├─ PengumumanForm.php
│  ├─ RecapAbsensi.php              (summary component)
│  ├─ MemberDashboard.php           (member view-only)
│  └─ AdminDashboard.php            (dashboard widgets)
│
├─ Models/
│  ├─ Anggota.php
│  ├─ Kegiatan.php
│  ├─ PendaftaranKegiatan.php
│  ├─ Absensi.php
│  ├─ TransaksiKas.php
│  ├─ Pengumuman.php
│  ├─ User.php
│  └─ AuditLog.php                  (track perubahan)
│
├─ Http/
│  ├─ Controllers/
│  │  ├─ PageController.php         (route halaman publik)
│  │  └─ AuthController.php         (login/logout logic)
│  │
│  └─ Middleware/
│     ├─ AdminMiddleware.php        (cek role admin)
│     └─ MemberMiddleware.php       (cek role member)
│
└─ Traits/
   └─ CanSearchAndFilter.php        (reusable search/filter logic)

resources/
├─ views/
│  ├─ layouts/
│  │  ├─ app.blade.php              (main layout dengan sidebar)
│  │  ├─ auth.blade.php             (layout login)
│  │  └─ components/
│  │     ├─ sidebar.blade.php
│  │     ├─ navbar.blade.php
│  │     ├─ button.blade.php
│  │     ├─ modal.blade.php
│  │     ├─ alert.blade.php
│  │     └─ pagination.blade.php
│  │
│  ├─ pages/
│  │  ├─ dashboard.blade.php        (admin dashboard utama)
│  │  ├─ anggota.blade.php          (load <livewire:anggota-table />)
│  │  ├─ kegiatan.blade.php
│  │  ├─ pendaftaran-kegiatan.blade.php
│  │  ├─ absensi.blade.php
│  │  ├─ keuangan.blade.php
│  │  ├─ pengumuman.blade.php
│  │  ├─ member-dashboard.blade.php (member view)
│  │  ├─ index.blade.php            (halaman publik)
│  │  ├─ jadwal.blade.php           (public - jadwal kegiatan)
│  │  └─ pengumuman-publik.blade.php (public - pengumuman)
│  │
│  └─ livewire/
│     ├─ anggota-table.blade.php    (template Livewire component)
│     ├─ anggota-form.blade.php
│     ├─ kegiatan-table.blade.php
│     ├─ kegiatan-form.blade.php
│     ├─ pendaftaran-kegiatan-table.blade.php
│     ├─ pendaftaran-kegiatan-form.blade.php
│     ├─ absensi-table.blade.php
│     ├─ absensi-form.blade.php
│     ├─ transaksi-kas-table.blade.php
│     ├─ transaksi-kas-form.blade.php
│     ├─ pengumuman-table.blade.php
│     ├─ pengumuman-form.blade.php
│     ├─ recap-absensi.blade.php
│     ├─ member-dashboard.blade.php
│     └─ admin-dashboard.blade.php

database/
├─ migrations/
│  ├─ xxxx_create_anggota_table.php
│  ├─ xxxx_create_kegiatan_table.php
│  ├─ xxxx_create_pendaftaran_kegiatan_table.php
│  ├─ xxxx_create_absensi_table.php
│  ├─ xxxx_create_transaksi_kas_table.php
│  ├─ xxxx_create_pengumuman_table.php
│  ├─ xxxx_create_audit_logs_table.php
│  ├─ xxxx_create_kas_rutin_config_table.php
│  └─ xxxx_create_triggers_and_functions.php  (raw SQL)
│
└─ seeders/
   ├─ DatabaseSeeder.php
   ├─ UserSeeder.php
   ├─ AnggotaSeeder.php
   ├─ KegiatanSeeder.php
   └─ RolePermissionSeeder.php
```

---

## 3. Livewire Component Pattern — Contoh

### Contoh 1: AnggotaTable.php

```php
<?php

namespace App\Livewire;

use App\Models\Anggota;
use Livewire\Component;
use Livewire\WithPagination;

class AnggotaTable extends Component
{
    use WithPagination;
    
    public $search = '';
    public $status = ''; // aktif, nonaktif
    public $perPage = 15;
    
    // Reactivity: ketika search berubah, reset ke page 1
    #[\Livewire\Attributes\On('search')]
    public function updatingSearch($value)
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $anggota = Anggota::query()
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->paginate($this->perPage);
        
        return view('livewire.anggota-table', [
            'anggota' => $anggota,
        ]);
    }
    
    public function delete($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        
        session()->flash('message', "Anggota {$anggota->nama} berhasil dihapus");
    }
}
```

### Contoh 2: anggota-table.blade.php (Template)

```blade
<div>
    <!-- Search & Filter -->
    <div class="mb-4 flex gap-2">
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Cari nama atau email..."
            class="flex-1 px-3 py-2 border rounded"
        >
        <select wire:model.live="status" class="px-3 py-2 border rounded">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
        <a href="{{ route('anggota.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            + Tambah Anggota
        </a>
    </div>
    
    <!-- Tabel -->
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="border p-2">No</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $item)
            <tr>
                <td class="border p-2">{{ $loop->iteration }}</td>
                <td class="border p-2">{{ $item->nama }}</td>
                <td class="border p-2">{{ $item->email }}</td>
                <td class="border p-2">
                    <span class="px-2 py-1 rounded text-white 
                        {{ $item->status === 'aktif' ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="border p-2 flex gap-1">
                    <a href="{{ route('anggota.edit', $item->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                    <button wire:click="delete({{ $item->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Pagination -->
    <div class="mt-4">
        {{ $anggota->links() }}
    </div>
</div>
```

### Contoh 3: AnggotaForm.php

```php
<?php

namespace App\Livewire;

use App\Models\Anggota;
use Livewire\Component;

class AnggotaForm extends Component
{
    public $anggota_id;
    public $nama = '';
    public $email = '';
    public $no_hp = '';
    public $status = 'aktif';
    
    public $rules = [
        'nama' => 'required|string|max:100',
        'email' => 'required|email|unique:anggota,email',
        'no_hp' => 'required|digits_between:10,15',
        'status' => 'required|in:aktif,nonaktif',
    ];
    
    public function mount($anggota_id = null)
    {
        if ($anggota_id) {
            $anggota = Anggota::findOrFail($anggota_id);
            $this->anggota_id = $anggota->id;
            $this->nama = $anggota->nama;
            $this->email = $anggota->email;
            $this->no_hp = $anggota->no_hp;
            $this->status = $anggota->status;
            
            // Update unique rule untuk email (exclude current)
            $this->rules['email'] = "required|email|unique:anggota,email,{$anggota_id}";
        }
    }
    
    public function save()
    {
        $this->validate();
        
        if ($this->anggota_id) {
            $anggota = Anggota::findOrFail($this->anggota_id);
            $anggota->update([
                'nama' => $this->nama,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'status' => $this->status,
            ]);
            $message = "Anggota berhasil diupdate";
        } else {
            Anggota::create([
                'nama' => $this->nama,
                'email' => $this->email,
                'no_hp' => $this->no_hp,
                'status' => $this->status,
            ]);
            $message = "Anggota berhasil ditambahkan";
        }
        
        return redirect()->route('anggota.index')->with('message', $message);
    }
    
    public function render()
    {
        return view('livewire.anggota-form');
    }
}
```

---

## 4. Database Triggers & Functions (Raw SQL Migration)

### Migration: xxxx_create_triggers_and_functions.php

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Trigger 1: Update saldo kas saat insert transaksi
        DB::statement("
            CREATE TRIGGER update_saldo_after_insert
            AFTER INSERT ON transaksi_kas
            FOR EACH ROW
            BEGIN
                UPDATE kas_rutin_config 
                SET saldo = saldo + NEW.nominal 
                WHERE id = 1;
            END
        ");
        
        // Trigger 2: Update saldo kas saat delete transaksi
        DB::statement("
            CREATE TRIGGER update_saldo_after_delete
            AFTER DELETE ON transaksi_kas
            FOR EACH ROW
            BEGIN
                UPDATE kas_rutin_config 
                SET saldo = saldo - OLD.nominal 
                WHERE id = 1;
            END
        ");
        
        // Function 1: Hitung saldo bulan tertentu
        DB::statement("
            CREATE FUNCTION get_saldo_bulan(p_bulan INT, p_tahun INT)
            RETURNS DECIMAL(15,2)
            READS SQL DATA
            BEGIN
                RETURN (
                    SELECT COALESCE(SUM(nominal), 0) 
                    FROM transaksi_kas 
                    WHERE MONTH(tanggal_bayar) = p_bulan 
                    AND YEAR(tanggal_bayar) = p_tahun
                );
            END
        ");
        
        // Function 2: Hitung persentase absensi per anggota
        DB::statement("
            CREATE FUNCTION get_persentase_absensi(p_anggota_id INT)
            RETURNS DECIMAL(5,2)
            READS SQL DATA
            BEGIN
                DECLARE total_kegiatan INT;
                DECLARE total_hadir INT;
                
                SELECT COUNT(*) INTO total_kegiatan 
                FROM pendaftaran_kegiatan 
                WHERE anggota_id = p_anggota_id;
                
                SELECT COUNT(*) INTO total_hadir 
                FROM absensi 
                WHERE pendaftaran_kegiatan_id IN 
                    (SELECT id FROM pendaftaran_kegiatan WHERE anggota_id = p_anggota_id)
                AND status = 'hadir';
                
                RETURN IF(total_kegiatan = 0, 0, ROUND((total_hadir / total_kegiatan) * 100, 2));
            END
        ");
    }
    
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS update_saldo_after_insert");
        DB::statement("DROP TRIGGER IF EXISTS update_saldo_after_delete");
        DB::statement("DROP FUNCTION IF EXISTS get_saldo_bulan");
        DB::statement("DROP FUNCTION IF EXISTS get_persentase_absensi");
    }
};
```

---

## 5. Key Implementation Points

### Reactivity & Validation

- Use `wire:model.live` untuk real-time search/filter
- Use `wire:click` untuk action buttons
- Validation otomatis dengan `$rules` property
- Error message display dengan `@error` directive

### Authorization & Permission

- Use `@if(auth()->user()->can('create anggota'))` di template
- Middleware check di route
- Gate/Policy untuk model-level authorization

### Performance Optimization

- Paginate big tables (jangan select all)
- Use lazy evaluation untuk heavy queries
- Cache frequently accessed data (role, permission)
- Optimize database indexes

### Components Reusability

- Buat reusable Blade components (button, modal, alert)
- Trait untuk shared logic (search, filter, pagination)
- Keep component state minimal (only what's needed)

---

## 6. Development Workflow

1. **Create Model & Migration** → test di Tinker
2. **Create Livewire Component** → PHP logic + reactivity
3. **Create Blade Template** → HTML + wire: directives
4. **Create Route** → point ke page that loads component
5. **Add Authorization** → middleware + policy/gate
6. **Test Manually** → CRUD operations end-to-end
7. **Optimize** → query optimization, caching

---

## 7. Testing Strategy

### Per Component

- Test CRUD operations (Create, Read, Update, Delete)
- Test search/filter reactivity
- Test validation error handling
- Test authorization (who can access)

### Integration

- Test role-based access (Admin vs Member vs Bendahara)
- Test data consistency (triggers update saldo correctly)
- Test audit trail logging
- Test export features

### Manual Testing

- Login as each role, verify sidebar menu
- Try CRUD operations
- Try invalid inputs, verify error messages
- Check responsive design (mobile, tablet, desktop)

---

> **Status:** Reference untuk Full Livewire Implementation
> **Last updated:** 07 Oktober 2026
> **Next:** Lihat `09-roadmap-6-minggu.md` untuk timeline minggu ke minggu
