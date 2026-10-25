<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'KOMET Basketball Club - SIBASKET' }}</title>
        
        <!-- Description -->
        <meta name="description" content="KOMET: Lebih Dari Sekadar Tim, Kita Adalah Keluarga. Sistem Manajemen Klub Basket dengan fitur pendaftaran, kegiatan, dan dokumentasi.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Tailwind CSS (via CDN untuk cepat, atau bisa pakai compiled version) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Styles -->
        <style>
            * {
                font-family: 'Figtree', sans-serif;
            }

            /* Smooth Scroll */
            html {
                scroll-behavior: smooth;
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }
            ::-webkit-scrollbar-thumb {
                background: #FF6B35;
                border-radius: 4px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #e55a26;
            }

            /* Animation */
            @keyframes slideInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-slide-in-down {
                animation: slideInDown 0.6s ease-out;
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out;
            }

            /* Gradient Background */
            .bg-gradient-hero {
                background: linear-gradient(135deg, #1F3A5F 0%, #2d5a8c 50%, #1a2f4d 100%);
            }

            .bg-gradient-cta {
                background: linear-gradient(135deg, #FF6B35 0%, #ff8c5a 50%, #e55a26 100%);
            }

            /* Smooth transitions */
            button, a {
                transition: all 0.3s ease;
            }
        </style>

        @stack('styles')
    </head>
    <body class="bg-gray-50">
        <!-- Navbar -->
        @include('components.public-navbar')

        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        @include('components.public-footer')

        <!-- Scripts -->
        <!-- GSAP & Lenis Smooth Scroll CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>

        <script>
            // Mobile Menu Toggle
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuBtn = document.getElementById('mobile-menu-btn');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuBtn) {
                    mobileMenuBtn.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                    });
                }
            });
        </script>

        @stack('scripts')
    </body>
</html>
