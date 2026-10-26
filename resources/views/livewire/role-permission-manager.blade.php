<div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header & Stats -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                Role & Permission Management
            </h1>
            <p class="text-sm text-gray-600 mt-1">
                Kelola hak akses, perizinan modul, dan pengelompokan role pengguna SIBASKET.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium">Total Roles</div>
                    <div class="text-lg font-bold text-gray-900">{{ count($roles) }}</div>
                </div>
            </div>
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium">Permissions</div>
                    <div class="text-lg font-bold text-gray-900">{{ count($permissions) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- LEFT: ROLES MANAGEMENT (7 cols) -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Daftar Roles</h2>
                        <p class="text-xs text-gray-500">Peran aktif dalam sistem aplikasi</p>
                    </div>
                    <button 
                        wire:click="toggleCreateRoleForm"
                        class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 shadow-sm transition flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Role
                    </button>
                </div>

                <!-- Create Role Form Box -->
                @if ($showCreateRoleForm)
                    <div class="p-6 bg-blue-50/60 border-b border-blue-100 animate-fadeIn">
                        <h3 class="text-sm font-bold text-blue-900 mb-3">Buat Role Baru</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Role</label>
                                <input 
                                    type="text" 
                                    wire:model.defer="newRoleName"
                                    placeholder="Contoh: Koordinator Lapangan"
                                    class="w-full px-3 py-2 text-sm bg-white border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                                @error('newRoleName')
                                    <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex items-center gap-2 pt-1">
                                <button 
                                    wire:click="createRole"
                                    class="px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm"
                                >
                                    Simpan Role
                                </button>
                                <button 
                                    wire:click="toggleCreateRoleForm"
                                    class="px-3 py-2 bg-white text-gray-700 text-xs font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition"
                                >
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Duplicate Role Form Box -->
                @if ($duplicatingRoleId)
                    <div class="p-6 bg-amber-50/60 border-b border-amber-100 animate-fadeIn">
                        <h3 class="text-sm font-bold text-amber-900 mb-1">Duplikasi Role</h3>
                        <p class="text-xs text-amber-700 mb-3">
                            Menyalin permissions dari role: <span class="font-semibold">{{ str_replace('_', ' ', collect($roles)->firstWhere('id', $duplicatingRoleId)['name'] ?? '') }}</span>
                        </p>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Role Baru</label>
                                <input 
                                    type="text" 
                                    wire:model.defer="newRoleName"
                                    placeholder="Contoh: Wakil Bendahara"
                                    class="w-full px-3 py-2 text-sm bg-white border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none"
                                />
                                @error('newRoleName')
                                    <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex items-center gap-2 pt-1">
                                <button 
                                    wire:click="duplicateRole"
                                    class="px-4 py-2 bg-amber-600 text-white text-xs font-semibold rounded-lg hover:bg-amber-700 transition shadow-sm"
                                >
                                    Proses Duplikasi
                                </button>
                                <button 
                                    wire:click="cancelDuplicateRole"
                                    class="px-3 py-2 bg-white text-gray-700 text-xs font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition"
                                >
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Roles List items -->
                <div class="divide-y divide-gray-100">
                    @forelse ($roles as $role)
                        <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-gray-50/60 transition">
                            <div class="flex items-start space-x-3">
                                <div class="p-2.5 bg-gray-100 text-gray-600 rounded-xl font-bold text-sm">
                                    {{ strtoupper(substr($role['name'], 0, 2)) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-bold text-gray-900 capitalize text-base">
                                            {{ str_replace('_', ' ', $role['name']) }}
                                        </h3>
                                        @if($role['name'] === 'super_admin')
                                            <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full">System</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                        <span class="flex items-center gap-1 font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ count($rolePermissions[$role['id']] ?? []) }} permissions
                                        </span>
                                        <span>•</span>
                                        <span>{{ $roleUserCounts[$role['id']] ?? 0 }} pengguna</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-1.5 self-end sm:self-center">
                                <button 
                                    wire:click="editRolePermissions({{ $role['id'] }})"
                                    class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white text-xs font-semibold rounded-lg transition"
                                    title="Edit Hak Akses"
                                >
                                    Permissions
                                </button>
                                <button 
                                    wire:click="startDuplicateRole({{ $role['id'] }})"
                                    class="px-3 py-1.5 bg-gray-50 text-gray-600 hover:bg-gray-200 text-xs font-semibold rounded-lg transition"
                                    title="Duplikat Role"
                                >
                                    Copy
                                </button>
                                @if ($role['name'] !== 'super_admin')
                                    <button 
                                        wire:click="deleteRole({{ $role['id'] }})"
                                        wire:confirm="Hapus role {{ $role['name'] }}? Tindakan ini tidak dapat dibatalkan jika masih ada relasi."
                                        class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white text-xs font-semibold rounded-lg transition"
                                    >
                                        Hapus
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500 text-sm">Belum ada role terdaftar.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT: PERMISSIONS MANAGEMENT (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Daftar Permissions</h2>
                        <p class="text-xs text-gray-500">Izin aksi modul aplikasi</p>
                    </div>
                    <button 
                        wire:click="toggleCreatePermissionForm"
                        class="px-3 py-2 bg-emerald-600 text-white text-xs font-semibold rounded-xl hover:bg-emerald-700 shadow-sm transition flex items-center gap-1.5"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah
                    </button>
                </div>

                <!-- Create Permission Form -->
                @if ($showCreatePermissionForm)
                    <div class="p-5 bg-emerald-50/60 border-b border-emerald-100 animate-fadeIn">
                        <h3 class="text-xs font-bold text-emerald-900 mb-2">Buat Permission Baru</h3>
                        <div class="space-y-3">
                            <div>
                                <input 
                                    type="text" 
                                    wire:model.defer="newPermissionName"
                                    placeholder="Contoh: export laporan"
                                    class="w-full px-3 py-2 text-xs bg-white border border-emerald-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none"
                                />
                                @error('newPermissionName')
                                    <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex items-center gap-2">
                                <button 
                                    wire:click="createPermission"
                                    class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition"
                                >
                                    Simpan
                                </button>
                                <button 
                                    wire:click="toggleCreatePermissionForm"
                                    class="px-3 py-1.5 bg-white text-gray-700 text-xs font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition"
                                >
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Search & Filters -->
                <div class="p-4 bg-gray-50/80 border-b border-gray-100 space-y-3">
                    <div>
                        <input 
                            type="text" 
                            wire:model.live="searchPermission"
                            placeholder="Cari permission..."
                            class="w-full px-3 py-1.5 text-xs bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>
                    <div class="flex flex-wrap gap-1">
                        <button 
                            wire:click="$set('selectedCategory', 'all')"
                            class="px-2.5 py-1 text-[11px] font-semibold rounded-md transition {{ $selectedCategory === 'all' ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-100' }}"
                        >
                            Semua
                        </button>
                        @foreach ($categories as $cat)
                            <button 
                                wire:click="$set('selectedCategory', '{{ $cat }}')"
                                class="px-2.5 py-1 text-[11px] font-semibold rounded-md transition {{ $selectedCategory === $cat ? 'bg-blue-600 text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-100' }}"
                            >
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Permissions List scrollable -->
                <div class="max-h-[380px] overflow-y-auto divide-y divide-gray-100">
                    @forelse ($filteredPermissions as $permission)
                        <div class="px-5 py-2.5 flex items-center justify-between hover:bg-gray-50 transition">
                            <div>
                                <span class="text-xs font-semibold text-gray-800 capitalize">
                                    {{ str_replace('_', ' ', $permission['name']) }}
                                </span>
                                <div class="text-[10px] text-gray-400">
                                    {{ $this->getPermissionCategory($permission['name']) }}
                                </div>
                            </div>
                            <button 
                                wire:click="deletePermission({{ $permission['id'] }})"
                                wire:confirm="Hapus permission ini dari sistem?"
                                class="text-gray-400 hover:text-red-600 p-1 rounded transition"
                                title="Hapus Permission"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-400 text-xs">Permission tidak ditemukan.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- MODAL: ASSIGN PERMISSIONS -->
    @if ($editingRoleId)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl overflow-hidden flex flex-col max-h-[90vh] animate-scaleUp">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">
                            Kelola Akses Role: 
                            <span class="text-blue-600 capitalize">
                                {{ str_replace('_', ' ', collect($roles)->firstWhere('id', $editingRoleId)['name'] ?? '') }}
                            </span>
                        </h3>
                        <p class="text-xs text-gray-500">Centang permission yang diizinkan untuk role ini</p>
                    </div>
                    <button wire:click="cancelEditRolePermissions" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto space-y-6 flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($permissions as $permission)
                            <label class="flex items-center gap-3 p-3 bg-gray-50/60 hover:bg-blue-50/50 border border-gray-100 rounded-xl cursor-pointer transition">
                                <input 
                                    type="checkbox" 
                                    wire:click="togglePermissionForRole({{ $permission['id'] }})"
                                    {{ in_array($permission['id'], $selectedPermissionsForRole) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                />
                                <span class="text-xs font-semibold text-gray-800 capitalize">
                                    {{ str_replace('_', ' ', $permission['name']) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button 
                        wire:click="cancelEditRolePermissions"
                        class="px-4 py-2 bg-white text-gray-700 text-xs font-semibold rounded-xl border border-gray-200 hover:bg-gray-100 transition"
                    >
                        Batal
                    </button>
                    <button 
                        wire:click="saveRolePermissions"
                        class="px-5 py-2 bg-blue-600 text-white text-xs font-semibold rounded-xl hover:bg-blue-700 shadow-sm transition"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- PERMISSION MATRIX TABLE -->
    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-bold text-gray-900">Matriks Hak Akses Keseluruhan</h2>
            <p class="text-xs text-gray-500">Tinjauan visual distribusi permission per role</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 uppercase text-[11px] font-bold tracking-wider border-b border-gray-100">
                        <th class="px-6 py-3.5">Permission / Modul</th>
                        @foreach ($roles as $role)
                            <th class="px-6 py-3.5 text-center capitalize whitespace-nowrap">
                                {{ str_replace('_', ' ', $role['name']) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs">
                    @foreach ($permissions as $permission)
                        <tr class="hover:bg-gray-50/60 transition">
                            <td class="px-6 py-3.5 font-semibold text-gray-800 capitalize">
                                {{ str_replace('_', ' ', $permission['name']) }}
                            </td>
                            @foreach ($roles as $role)
                                <td class="px-6 py-3.5 text-center">
                                    @if (in_array($permission['id'], $rolePermissions[$role['id']] ?? []))
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full font-bold">
                                            ✓
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-300 rounded-full">
                                            -
                                        </span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@script
<script>
    Livewire.on('notify', (data) => {
        const { type, message } = data[0];
        
        const notification = document.createElement('div');
        notification.className = `fixed bottom-6 right-6 px-5 py-3 rounded-2xl shadow-xl text-white text-xs font-semibold z-50 flex items-center gap-2 transform translate-y-2 opacity-0 transition-all duration-300 ${
            type === 'success' ? 'bg-emerald-600' : (type === 'warning' ? 'bg-amber-600' : 'bg-red-600')
        }`;
        notification.innerHTML = `<span>${message}</span>`;
        
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.classList.remove('translate-y-2', 'opacity-0');
        }, 10);
        
        setTimeout(() => {
            notification.classList.add('translate-y-2', 'opacity-0');
            setTimeout(() => notification.remove(), 300);
        }, 3500);
    });
</script>
@endscript
