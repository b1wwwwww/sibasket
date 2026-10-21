<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ session('theme', 'light') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SI-Basket') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            // Initialize theme from session ONLY on page load
            // Session is the source of truth, localStorage is synced from navbar toggle
            const htmlElement = document.documentElement;
            const theme = '{{ session("theme", "light") }}' || 'light';
            
            if (theme === 'dark') {
                htmlElement.classList.add('dark');
            } else {
                htmlElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="min-h-screen flex">
            @if(!app()->runningUnitTests())
                <!-- Sidebar -->
                <livewire:sidebar />
            @endif

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                @if(!app()->runningUnitTests())
                    <!-- Navbar -->
                    <livewire:navbar />
                @endif

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-y-auto">
                    @yield('content')
                </main>
            </div>
        </div>

        <script>
            // Listen for Livewire theme toggle events
            Livewire.on('themeToggled', (event) => {
                const theme = event.detail.theme;
                const htmlElement = document.documentElement;
                
                if (theme === 'dark') {
                    htmlElement.classList.add('dark');
                } else {
                    htmlElement.classList.remove('dark');
                }
                
                localStorage.setItem('theme', theme);
            });
        </script>
    </body>
</html>
