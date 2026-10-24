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

        <!-- Trix Editor -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
        <script src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.min.js"></script>

        <!-- Trix Dark Mode Styling -->
        <style>
            trix-editor {
                border: 1px solid #d1d5db;
                border-radius: 0.5rem;
                padding: 0.75rem;
                background: white;
                color: #111827;
                min-height: 250px;
            }

            .dark trix-editor {
                border-color: #6b7280;
                background: #111827;
                color: #f9fafb;
            }

            trix-editor:focus {
                outline: 2px solid #3b82f6;
                outline-offset: 2px;
            }

            trix-editor::placeholder {
                color: #9ca3af;
            }

            .dark trix-editor::placeholder {
                color: #6b7280;
            }

            trix-toolbar {
                border: 1px solid #d1d5db;
                border-bottom: 2px solid #d1d5db;
                border-radius: 0.5rem 0.5rem 0 0;
                background: #f9fafb;
                padding: 0.5rem;
            }

            .dark trix-toolbar {
                border-color: #4b5563;
                background: #1f2937;
            }

            trix-toolbar button {
                color: #374151;
                border: 1px solid transparent;
                border-radius: 0.25rem;
                padding: 0.25rem 0.5rem;
            }

            .dark trix-toolbar button {
                color: #e5e7eb;
            }

            trix-toolbar button:hover {
                background: #e5e7eb;
                border-color: #d1d5db;
            }

            .dark trix-toolbar button:hover {
                background: #374151;
                border-color: #6b7280;
            }

            trix-toolbar button.trix-active {
                background: #dbeafe;
                color: #1e40af;
                border-color: #93c5fd;
            }

            .dark trix-toolbar button.trix-active {
                background: #1e3a8a;
                color: #93c5fd;
                border-color: #3b82f6;
            }

            /* Remove file upload button */
            trix-toolbar .trix-button-group--file-tools {
                display: none;
            }
        </style>

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
