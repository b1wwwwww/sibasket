<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{
    public $theme = 'light';
    public $showNotifications = false;
    public $showUserMenu = false;

    public function mount()
    {
        // Force reset to 'light' if session is not set or reset localStorage mismatch
        if (!session()->has('theme')) {
            session(['theme' => 'light']);
        }
        
        $this->theme = session('theme', 'light');
    }

    public function toggleTheme()
    {
        $this->theme = $this->theme === 'light' ? 'dark' : 'light';
        session(['theme' => $this->theme]);
        
        // Dispatch event to update all components
        $this->dispatch('themeToggled', theme: $this->theme);
    }

    public function toggleNotifications()
    {
        $this->showNotifications = !$this->showNotifications;
    }

    public function toggleUserMenu()
    {
        $this->showUserMenu = !$this->showUserMenu;
    }

    public function logout()
    {
        \Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
