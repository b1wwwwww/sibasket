<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DeleteUserForm extends Component
{
    #[Validate('required|string|current_password:web')]
    public string $password = '';

    public function deleteUser(): void
    {
        $this->validate();

        $user = Auth::user();
        Auth::logout();
        $user->delete();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}
