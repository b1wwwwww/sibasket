<div class="sticky top-0 z-40 shrink-0 border-b border-gray-200 bg-white transition-colors duration-300 dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
        <!-- Left: Breadcrumb (desktop only) -->
        <div class="hidden md:block text-sm text-gray-600 dark:text-gray-400">
            <span>Dashboard</span>
        </div>

        <!-- Right: Icons & Menu -->
        <div class="flex items-center gap-4 ml-auto">
            <!-- Theme Toggle Button -->
            <button 
                wire:click="toggleTheme"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors duration-300"
                title="Switch theme"
            >
                @if($theme === 'light')
                    <!-- Sun Icon (Light Mode) -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l-2.12-2.12a4 4 0 00-5.656 0l-.707.707a1 1 0 001.414 1.414l.707-.707a2 2 0 012.828 0l2.12 2.12a1 1 0 001.414-1.414zM2.05 13.536A1 1 0 103.464 12.12M17.657 18.657a1 1 0 001.414-1.414M9 17a1 1 0 11-2 0 1 1 0 012 0zm6.364-2.343l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zM5 5a1 1 0 011 1v1a1 1 0 11-2 0V6a1 1 0 011-1zm12 0a1 1 0 011 1v1a1 1 0 11-2 0V6a1 1 0 011-1z"/>
                    </svg>
                @else
                    <!-- Moon Icon (Dark Mode) -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                    </svg>
                @endif
            </button>

            <!-- Notifications Button -->
            <div class="relative">
                <button 
                    wire:click="toggleNotifications"
                    class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors duration-300"
                    title="Notifications"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 100 12A6 6 0 0010 2zM0 10a1 1 0 011-1h2a1 1 0 110 2H1a1 1 0 01-1-1zm17-1h2a1 1 0 110 2h-2a1 1 0 110-2zM4.216 4.216a1 1 0 011.414 0l1.414 1.414a1 1 0 11-1.414 1.414l-1.414-1.414zM12.95 12.95a1 1 0 011.414 0l1.414 1.414a1 1 0 01-1.414 1.414l-1.414-1.414zM4.216 15.784a1 1 0 000 1.414l1.414 1.414a1 1 0 001.414-1.414l-1.414-1.414zM12.95 7.05a1 1 0 000 1.414l1.414 1.414a1 1 0 101.414-1.414L14.364 7.05z"/>
                    </svg>
                    <!-- Red Notification Dot -->
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Notifications Dropdown -->
                @if($showNotifications)
                    <div class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Notifikasi</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <!-- Notification Item 1 -->
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Kegiatan baru tersedia</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Latihan Rutin Basket - 20 Okt 2026</p>
                            </div>
                            <!-- Notification Item 2 -->
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Pengumuman penting dari admin</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Event Turnamen Basketball</p>
                            </div>
                            <!-- Notification Item 3 -->
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Absensi hari ini dibuka</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Latihan Rutin Basket</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- User Profile Dropdown -->
            <div class="relative">
                <button 
                    wire:click="toggleUserMenu"
                    class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300"
                    title="User menu"
                >
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden sm:inline text-sm font-medium text-gray-900 dark:text-white">
                        {{ auth()->user()->name }}
                    </span>
                </button>

                <!-- User Menu Dropdown -->
                @if($showUserMenu)
                    <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                            <span class="text-sm">Edit Profil</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/></svg>
                            <span class="text-sm">Ubah Password</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 text-red-600 dark:text-red-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm10.293 9.293a1 1 0 001.414-1.414L11.414 10l2.293-2.293a1 1 0 00-1.414-1.414L10 8.586 7.707 6.293a1 1 0 00-1.414 1.414L8.586 10l-2.293 2.293a1 1 0 001.414 1.414L10 11.414l2.293 2.293z"/></svg>
                                <span class="text-sm">Logout</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
