<?php

namespace App\Livewire;

use App\Models\Pengumuman;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PengumumanForm extends Component
{
    use WithFileUploads;

    public $pengumuman_id = null;
    public $judul = '';
    public $isi = '';
    public $tanggal_publish = '';
    public $status = 'published';
    public $kategori = '';
    public $foto_file = null;
    public $foto_path = '';
    public $is_pinned = false;
    public $publish_mode = 'now'; // 'now' atau 'scheduled'
    public $scheduled_at = '';
    public $show_preview = false;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'status' => 'required|in:draft,published',
        'kategori' => 'nullable|string|max:255',
        'foto_file' => 'nullable|image|max:2048',
        'is_pinned' => 'boolean',
        'publish_mode' => 'required|in:now,scheduled',
        'scheduled_at' => 'nullable|date_format:Y-m-d\TH:i|after:now',
    ];

    protected $messages = [
        'judul.required' => 'Judul pengumuman harus diisi',
        'judul.max' => 'Judul maksimal 255 karakter',
        'isi.required' => 'Isi pengumuman harus diisi',
        'status.required' => 'Status harus dipilih',
        'foto_file.image' => 'File harus berupa gambar',
        'foto_file.max' => 'Ukuran foto maksimal 2MB',
        'scheduled_at.date_format' => 'Format tanggal harus YYYY-MM-DD dengan jam',
        'scheduled_at.after' => 'Waktu publish harus di masa depan',
    ];

    public function mount($pengumuman_id = null)
    {
        if ($pengumuman_id) {
            $pengumuman = Pengumuman::findOrFail($pengumuman_id);
            $this->pengumuman_id = $pengumuman_id;
            $this->judul = $pengumuman->judul;
            $this->isi = $pengumuman->isi;
            $this->tanggal_publish = $pengumuman->tanggal_publish->format('Y-m-d\TH:i');
            $this->status = $pengumuman->status;
            $this->kategori = $pengumuman->kategori;
            $this->foto_path = $pengumuman->foto;
            $this->is_pinned = $pengumuman->is_pinned;
            $this->scheduled_at = $pengumuman->scheduled_at?->format('Y-m-d\TH:i') ?? '';
            $this->publish_mode = $pengumuman->scheduled_at ? 'scheduled' : 'now';
        } else {
            $this->tanggal_publish = now()->format('Y-m-d\TH:i');
            $this->status = 'published';
            $this->publish_mode = 'now';
        }
    }

    public function togglePreview()
    {
        $this->show_preview = !$this->show_preview;
    }

    // Update isi content dari Trix editor via JavaScript
    public function updateIsi($content)
    {
        $this->isi = $content;
    }

    public function syncAndSave()
    {
        // Method untuk handle sync + save dalam satu langkah
        // Nilai $isi sudah di-update via updateIsi() saat user mengetik
        $this->save();
    }

    public function save()
    {
        // Validate scheduled_at only if publish_mode is scheduled
        if ($this->publish_mode === 'scheduled') {
            $this->validate(['scheduled_at' => 'required|date_format:Y-m-d\TH:i|after:now']);
        }

        $this->validate();

        $fotoPath = $this->foto_path;

        // Handle file upload jika ada foto baru
        if ($this->foto_file) {
            // Hapus foto lama jika ada
            if ($this->foto_path && Storage::disk('public')->exists($this->foto_path)) {
                Storage::disk('public')->delete($this->foto_path);
            }

            // Simpan foto baru
            $fotoPath = $this->foto_file->store('pengumuman', 'public');
        }

        // Determine tanggal_publish dan status
        $tanggal_publish = $this->tanggal_publish;
        $status = $this->status;
        $scheduled_at = null;

        if ($this->publish_mode === 'scheduled') {
            $status = 'draft';
            $scheduled_at = $this->scheduled_at;
        }

        if ($this->pengumuman_id) {
            $pengumuman = Pengumuman::findOrFail($this->pengumuman_id);
            $pengumuman->update([
                'judul' => $this->judul,
                'isi' => $this->isi,
                'tanggal_publish' => $tanggal_publish,
                'status' => $status,
                'kategori' => $this->kategori ?: null,
                'foto' => $fotoPath ?: null,
                'is_pinned' => $this->is_pinned,
                'scheduled_at' => $scheduled_at,
            ]);
            $message = 'Pengumuman berhasil diperbarui';
        } else {
            Pengumuman::create([
                'judul' => $this->judul,
                'isi' => $this->isi,
                'tanggal_publish' => $tanggal_publish,
                'status' => $status,
                'kategori' => $this->kategori ?: null,
                'foto' => $fotoPath ?: null,
                'is_pinned' => $this->is_pinned,
                'scheduled_at' => $scheduled_at,
            ]);
            $message = 'Pengumuman berhasil dibuat';
        }

        $this->dispatch('notify', message: $message);
        return redirect()->route('pengumuman.index');
    }

    public function render()
    {
        return view('livewire.pengumuman-form');
    }
}
