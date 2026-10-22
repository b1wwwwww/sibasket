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
            function applyTheme(theme) {
                const normalizedTheme = theme === 'dark' ? 'dark' : 'light';
                const htmlElement = document.documentElement;

                htmlElement.classList.toggle('dark', normalizedTheme === 'dark');
                localStorage.setItem('theme', normalizedTheme);
                return normalizedTheme;
            }

            function syncThemeFromStorage() {
                const savedTheme = localStorage.getItem('theme');
                const sessionTheme = '{{ session("theme", "light") }}';
                const nextTheme = savedTheme || sessionTheme || 'light';
                applyTheme(nextTheme);
            }

            syncThemeFromStorage();

            window.addEventListener('themeToggled', (event) => {
                const selectedTheme = event.detail?.theme || localStorage.getItem('theme') || 'light';
                applyTheme(selectedTheme);
            });

            Livewire.on('themeToggled', (event) => {
                const selectedTheme = event.detail?.theme || event.theme || 'light';
                applyTheme(selectedTheme);
            });

            document.addEventListener('livewire:navigated', () => {
                syncThemeFromStorage();
            });
        </script>
    </head>
    <body class="h-screen overflow-hidden font-sans antialiased bg-gray-100 transition-colors duration-300 dark:bg-gray-900">
        <div class="flex h-screen overflow-hidden">
            @if(!app()->runningUnitTests())
                <!-- Sidebar -->
                <livewire:sidebar />
            @endif

            <!-- Main Content Area -->
            <div class="flex min-h-0 min-w-0 flex-1 flex-col overflow-hidden">
                @if(!app()->runningUnitTests())
                    <!-- Navbar -->
                    <livewire:navbar />
                @endif

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="border-b border-gray-200 bg-white shadow-sm transition-colors duration-300 dark:border-gray-700 dark:bg-gray-800">
                        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="min-h-0 flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                    @yield('content')
                </main>
            </div>
        </div>

    </body>
</html>
