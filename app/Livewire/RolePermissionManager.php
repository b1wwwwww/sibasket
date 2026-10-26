<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionManager extends Component
{
    // State untuk view
    public $roles = [];
    public $permissions = [];
    public $rolePermissions = []; // Mapping role -> permissions
    public $roleUserCounts = []; // User count per role
    
    // State untuk create role
    public $newRoleName = '';
    public $newRoleGuard = 'web';
    public $showCreateRoleForm = false;
    
    // State untuk create permission
    public $newPermissionName = '';
    public $newPermissionGuard = 'web';
    public $showCreatePermissionForm = false;
    
    // State untuk edit
    public $editingRoleId = null;
    public $selectedPermissionsForRole = [];
    public $duplicatingRoleId = null;
    
    // Search & filter
    public $searchPermission = '';
    public $selectedCategory = 'all';
    
    public function mount()
    {
        $this->authorize('manage role_permission');
        $this->loadData();
    }
    
    public function loadData()
    {
        $this->roles = Role::orderBy('name')->get()->toArray();
        $this->permissions = Permission::orderBy('name')->get()->toArray();
        
        // Load mapping role -> permissions
        $this->rolePermissions = [];
        foreach (Role::with('permissions')->get() as $role) {
            $this->rolePermissions[$role->id] = $role->permissions->pluck('id')->toArray();
        }
        
        // Load user count per role
        $this->roleUserCounts = [];
        foreach (Role::withCount('users')->get() as $role) {
            $this->roleUserCounts[$role->id] = $role->users_count;
        }
    }
    
    public function getPermissionCategory($permissionName)
    {
        $name = strtolower($permissionName);
        if (strpos($name, 'anggota') !== false) return 'Anggota';
        if (strpos($name, 'kegiatan') !== false) return 'Kegiatan';
        if (strpos($name, 'absensi') !== false) return 'Absensi';
        if (strpos($name, 'pengumuman') !== false) return 'Pengumuman';
        if (strpos($name, 'keuangan') !== false) return 'Keuangan';
        if (strpos($name, 'pendaftaran') !== false) return 'Pendaftaran';
        if (strpos($name, 'laporan') !== false) return 'Laporan';
        if (strpos($name, 'role_permission') !== false) return 'System';
        return 'Lainnya';
    }
    
    public function getFilteredPermissions()
    {
        $filtered = $this->permissions;
        
        // Filter by search
        if ($this->searchPermission) {
            $search = strtolower($this->searchPermission);
            $filtered = array_filter($filtered, function($p) use ($search) {
                return strpos(strtolower($p['name']), $search) !== false;
            });
        }
        
        // Filter by category
        if ($this->selectedCategory !== 'all') {
            $filtered = array_filter($filtered, function($p) {
                return $this->getPermissionCategory($p['name']) === $this->selectedCategory;
            });
        }
        
        return array_values($filtered);
    }
    
    // ===== CREATE ROLE =====
    public function toggleCreateRoleForm()
    {
        $this->showCreateRoleForm = !$this->showCreateRoleForm;
        if (!$this->showCreateRoleForm) {
            $this->newRoleName = '';
        }
    }
    
    public function createRole()
    {
        $this->validate([
            'newRoleName' => 'required|string|min:3|max:50|unique:roles,name',
        ], [
            'newRoleName.required' => 'Nama role wajib diisi.',
            'newRoleName.unique' => 'Role dengan nama ini sudah ada.',
            'newRoleName.min' => 'Nama role minimal 3 karakter.',
        ]);
        
        try {
            Role::create([
                'name' => strtolower(str_replace(' ', '_', $this->newRoleName)),
                'guard_name' => $this->newRoleGuard,
            ]);
            
            $this->newRoleName = '';
            $this->showCreateRoleForm = false;
            $this->loadData();
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Role berhasil dibuat.',
            ]);
        } catch (Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal membuat role: ' . $e->getMessage(),
            ]);
        }
    }
    
    // ===== DELETE ROLE =====
    public function deleteRole($roleId)
    {
        try {
            $role = Role::find($roleId);
            if ($role && $role->name !== 'super_admin') {
                // Check if role has users
                if ($role->users()->count() > 0) {
                    $this->dispatch('notify', [
                        'type' => 'warning',
                        'message' => 'Tidak bisa menghapus role yang masih memiliki pengguna.',
                    ]);
                    return;
                }
                
                $role->delete();
                $this->loadData();
                
                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Role berhasil dihapus.',
                ]);
            } else {
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Role super_admin tidak bisa dihapus.',
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal menghapus role: ' . $e->getMessage(),
            ]);
        }
    }
    
    // ===== DUPLICATE ROLE =====
    public function startDuplicateRole($roleId)
    {
        $this->duplicatingRoleId = $roleId;
    }
    
    public function cancelDuplicateRole()
    {
        $this->duplicatingRoleId = null;
        $this->newRoleName = '';
    }
    
    public function duplicateRole()
    {
        if (!$this->duplicatingRoleId) {
            return;
        }
        
        $this->validate([
            'newRoleName' => 'required|string|min:3|max:50|unique:roles,name',
        ], [
            'newRoleName.required' => 'Nama role wajib diisi.',
            'newRoleName.unique' => 'Role dengan nama ini sudah ada.',
            'newRoleName.min' => 'Nama role minimal 3 karakter.',
        ]);
        
        try {
            $sourceRole = Role::find($this->duplicatingRoleId);
            if (!$sourceRole) {
                throw new \Exception('Role sumber tidak ditemukan.');
            }
            
            $newRole = Role::create([
                'name' => strtolower(str_replace(' ', '_', $this->newRoleName)),
                'guard_name' => 'web',
            ]);
            
            // Copy permissions
            $permissions = $sourceRole->permissions()->pluck('name')->toArray();
            $newRole->syncPermissions($permissions);
            
            $this->newRoleName = '';
            $this->duplicatingRoleId = null;
            $this->loadData();
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Role berhasil di-duplicate dengan ' . count($permissions) . ' permissions.',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal duplicate role: ' . $e->getMessage(),
            ]);
        }
    }
    
    // ===== CREATE PERMISSION =====
    public function toggleCreatePermissionForm()
    {
        $this->showCreatePermissionForm = !$this->showCreatePermissionForm;
        if (!$this->showCreatePermissionForm) {
            $this->newPermissionName = '';
        }
    }
    
    public function createPermission()
    {
        $this->validate([
            'newPermissionName' => 'required|string|min:3|max:50|unique:permissions,name',
        ], [
            'newPermissionName.required' => 'Nama permission wajib diisi.',
            'newPermissionName.unique' => 'Permission dengan nama ini sudah ada.',
            'newPermissionName.min' => 'Nama permission minimal 3 karakter.',
        ]);
        
        try {
            Permission::create([
                'name' => strtolower(str_replace(' ', '_', $this->newPermissionName)),
                'guard_name' => $this->newPermissionGuard,
            ]);
            
            $this->newPermissionName = '';
            $this->showCreatePermissionForm = false;
            $this->loadData();
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Permission berhasil dibuat.',
            ]);
        } catch (Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal membuat permission: ' . $e->getMessage(),
            ]);
        }
    }
    
    // ===== DELETE PERMISSION =====
    public function deletePermission($permissionId)
    {
        try {
            $permission = Permission::find($permissionId);
            if ($permission) {
                $permission->delete();
                $this->loadData();
                
                $this->dispatch('notify', [
                    'type' => 'success',
                    'message' => 'Permission berhasil dihapus.',
                ]);
            }
        } catch (Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal menghapus permission: ' . $e->getMessage(),
            ]);
        }
    }
    
    // ===== ASSIGN PERMISSIONS TO ROLE =====
    public function editRolePermissions($roleId)
    {
        $this->editingRoleId = $roleId;
        $this->selectedPermissionsForRole = $this->rolePermissions[$roleId] ?? [];
    }
    
    public function cancelEditRolePermissions()
    {
        $this->editingRoleId = null;
        $this->selectedPermissionsForRole = [];
    }
    
    public function togglePermissionForRole($permissionId)
    {
        if (in_array($permissionId, $this->selectedPermissionsForRole)) {
            $this->selectedPermissionsForRole = array_filter(
                $this->selectedPermissionsForRole,
                fn($id) => $id !== $permissionId
            );
        } else {
            $this->selectedPermissionsForRole[] = $permissionId;
        }
    }
    
    public function saveRolePermissions()
    {
        try {
            $role = Role::find($this->editingRoleId);
            
            if (!$role) {
                throw new Exception('Role tidak ditemukan.');
            }
            
            // Sync permissions dengan selected
            $permissionNames = Permission::whereIn('id', $this->selectedPermissionsForRole)
                ->pluck('name')
                ->toArray();
            
            $role->syncPermissions($permissionNames);
            
            $this->editingRoleId = null;
            $this->selectedPermissionsForRole = [];
            $this->loadData();
            
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Permissions untuk role berhasil diupdate.',
            ]);
        } catch (Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Gagal update permissions: ' . $e->getMessage(),
            ]);
        }
    }
    
    public function render()
    {
        $totalUsers = \App\Models\User::count();
        
        return view('livewire.role-permission-manager', [
            'roles' => $this->roles,
            'permissions' => $this->permissions,
            'rolePermissions' => $this->rolePermissions,
            'roleUserCounts' => $this->roleUserCounts,
            'editingRoleId' => $this->editingRoleId,
            'selectedPermissionsForRole' => $this->selectedPermissionsForRole,
            'duplicatingRoleId' => $this->duplicatingRoleId,
            'filteredPermissions' => $this->getFilteredPermissions(),
            'totalUsers' => $totalUsers,
            'categories' => ['Anggota', 'Kegiatan', 'Absensi', 'Pengumuman', 'Keuangan', 'Pendaftaran', 'Laporan', 'System'],
        ]);
    }
}
