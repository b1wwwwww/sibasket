<?php

namespace App\Livewire;

use App\Models\PendaftaranAnggota;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class PendaftaranAnggotaTable extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = 'pending';
    
    // Untuk modal detail & reject
    public $selectedId;
    public $rejectionReason = '';
    public $showRejectModal = false;
    public $showDetailModal = false;
    public $selectedPendaftar;

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectPendaftar($id)
    {
        $this->selectedId = $id;
        $this->selectedPendaftar = PendaftaranAnggota::findOrFail($id);
        $this->showDetailModal = true;
    }

    public function approve($id)
    {
        $pendaftaran = PendaftaranAnggota::findOrFail($id);
        
        DB::transaction(function () use ($pendaftaran) {
            // 1. Buat User baru (email default: nama_panggilan@sibasket.com)
            $email = strtolower(str_replace(' ', '', $pendaftaran->nama_panggilan)) . '@sibasket.com';
            
            // Cek email ganda
            $count = User::where('email', 'like', $email . '%')->count();
            if ($count > 0) $email = str_replace('@', $count . '@', $email);

            $user = User::create([
                'name' => $pendaftaran->nama,
                'email' => $email,
                'password' => Hash::make('password123'),
            ]);

            $user->assignRole('member');

            // 2. Buat record Anggota
            $anggota = Anggota::create([
                'user_id' => $user->id,
                'nama' => $pendaftaran->nama,
                'jurusan' => $pendaftaran->jurusan,
                'status' => 'aktif',
                'tanggal_bergabung' => now(),
                'no_hp' => $pendaftaran->kontak_siswa,
            ]);

            // 3. Update status pendaftaran
            $pendaftaran->update([
                'status' => 'approved',
                'anggota_id' => $anggota->id
            ]);
        });

        session()->flash('success', "Pendaftaran {$pendaftaran->nama} berhasil disetujui!");
        $this->showDetailModal = false;
    }

    public function openRejectModal($id)
    {
        $this->selectedId = $id;
        $this->showRejectModal = true;
        $this->showDetailModal = false;
    }

    public function reject()
    {
        $this->validate([
            'rejectionReason' => 'required|min:5'
        ]);

        $pendaftaran = PendaftaranAnggota::findOrFail($this->selectedId);
        $pendaftaran->update([
            'status' => 'rejected',
            'alasan_ditolak' => $this->rejectionReason
        ]);

        session()->flash('error', "Pendaftaran {$pendaftaran->nama} ditolak.");
        $this->showRejectModal = false;
        $this->rejectionReason = '';
    }

    public function render()
    {
        return view('livewire.pendaftaran-anggota-table', [
            'pendaftar' => PendaftaranAnggota::where('status', $this->statusFilter)
                ->where(function($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('kontak_siswa', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
