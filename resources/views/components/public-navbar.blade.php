<nav id="main-public-navbar" class="sticky top-0 z-50 bg-[#0B1728]/95 backdrop-blur-md border-b border-slate-800/80 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 sm:h-[72px]">
            <!-- Logo -->
            <a href="{{ route('home') }}#home" class="flex items-center group">
                <img src="{{ asset('images/logo-komet.jpeg') }}" alt="KOMET Basketball Club" class="h-12 w-auto object-contain max-w-[180px] rounded-lg shadow-md shadow-orange-500/10 group-hover:scale-[1.02] transition-transform" />
            </a>

            <!-- Desktop Menu (Pills Style with Dynamic Scrollspy) -->
            <div id="desktop-nav-menu" class="hidden lg:flex items-center space-x-1 bg-[#102038]/70 px-3 py-1.5 rounded-full border border-slate-800">
                <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#home' : '#home' }}" data-nav="home"
                   class="nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 bg-[#FF6B35] text-white shadow-sm">
                    Home
                </a>
                <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#tentang-kami' : '#tentang-kami' }}" data-nav="tentang-kami"
                   class="nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 text-slate-300 hover:text-white hover:bg-slate-800/60">
                    Tentang Kami
                </a>
                <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#prestasi' : '#prestasi' }}" data-nav="prestasi"
                   class="nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 text-slate-300 hover:text-white hover:bg-slate-800/60">
                    Prestasi & Timeline
                </a>
                <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#kegiatan' : '#kegiatan' }}" data-nav="kegiatan"
                   class="nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 text-slate-300 hover:text-white hover:bg-slate-800/60">
                    Kegiatan & Pengumuman
                </a>
                <a href="{{ route('gallery.index') }}" data-nav="galeri"
                   class="nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 {{ request()->routeIs('gallery.*') ? 'bg-[#FF6B35] text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                    Galeri Dokumentasi
                </a>
            </div>

            <!-- Right CTA Buttons -->
            <div class="hidden sm:flex items-center space-x-3">
                @auth
                    <!-- Member Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-slate-200 hover:text-white bg-slate-800/80 px-3 py-1.5 rounded-lg border border-slate-700/80 transition">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=FF6B35&color=fff" 
                                 alt="Avatar" class="w-7 h-7 rounded-full">
                            <span class="text-xs font-semibold">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-[#0F1E36] border border-slate-700 rounded-xl shadow-2xl py-1.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-xs text-slate-200 hover:bg-[#FF6B35] hover:text-white transition">
                                <i class="fas fa-gauge mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('member.profile') }}" class="block px-4 py-2 text-xs text-slate-200 hover:bg-[#FF6B35] hover:text-white transition">
                                <i class="fas fa-user mr-2"></i> Profil Saya
                            </a>
                            <div class="border-t border-slate-700/80 my-1"></div>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-xs text-red-400 hover:bg-red-500/20 hover:text-red-300 transition" 
                               onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </div>
                    </div>

                    <form id="navbar-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('daftar.anggota') }}" 
                       class="px-4 py-2 bg-[#FF6B35] hover:bg-[#fa5a20] text-white text-xs font-bold rounded-md shadow-md shadow-orange-500/20 transition transform hover:scale-[1.02]">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" 
                       class="px-3.5 py-2 text-slate-200 hover:text-white hover:bg-slate-800/80 border border-slate-700/80 rounded-md text-xs font-medium transition">
                        Login SIBASKET
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-300 hover:text-white focus:outline-none" aria-label="Toggle Navigation">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden lg:hidden pb-5 pt-2 border-t border-slate-800 space-y-1.5">
            <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#home' : '#home' }}" data-nav="home" class="nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold bg-[#FF6B35] text-white">
                Home
            </a>
            <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#tentang-kami' : '#tentang-kami' }}" data-nav="tentang-kami" class="nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold text-slate-300 hover:bg-slate-800">
                Tentang Kami
            </a>
            <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#prestasi' : '#prestasi' }}" data-nav="prestasi" class="nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold text-slate-300 hover:bg-slate-800">
                Prestasi & Timeline
            </a>
            <a href="{{ request()->routeIs('gallery.*') ? route('home') . '#kegiatan' : '#kegiatan' }}" data-nav="kegiatan" class="nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold text-slate-300 hover:bg-slate-800">
                Kegiatan & Pengumuman
            </a>
            <a href="{{ route('gallery.index') }}" data-nav="galeri" class="nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold {{ request()->routeIs('gallery.*') ? 'bg-[#FF6B35] text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                Galeri Dokumentasi
            </a>

            <div class="pt-3 border-t border-slate-800/80 space-y-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800 rounded-lg">
                        <i class="fas fa-gauge mr-2 text-orange-400"></i> Dashboard
                    </a>
                    <a href="{{ route('member.profile') }}" class="block px-3 py-2 text-xs font-semibold text-slate-200 hover:bg-slate-800 rounded-lg">
                        <i class="fas fa-user mr-2 text-orange-400"></i> Profil Saya
                    </a>
                    <a href="{{ route('logout') }}" class="block px-3 py-2 text-xs font-semibold text-red-400 hover:bg-red-500/20 rounded-lg"
                       onclick="event.preventDefault(); document.getElementById('navbar-logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                @else
                    <a href="{{ route('daftar.anggota') }}" class="block w-full text-center px-4 py-2.5 bg-[#FF6B35] hover:bg-[#fa5a20] text-white text-xs font-bold rounded-lg shadow">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2 text-slate-200 hover:text-white border border-slate-700 rounded-lg text-xs font-medium">
                        Login SIBASKET
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const desktopItems = document.querySelectorAll('.nav-item');
        const mobileItems = document.querySelectorAll('.nav-item-mobile');
        const sections = [
            { id: 'home', element: document.getElementById('home') },
            { id: 'tentang-kami', element: document.getElementById('tentang-kami') },
            { id: 'prestasi', element: document.getElementById('prestasi') },
            { id: 'kegiatan', element: document.getElementById('kegiatan') }
        ];

        function setActiveNav(targetId) {
            desktopItems.forEach(item => {
                const navTarget = item.getAttribute('data-nav');
                if (navTarget === targetId) {
                    item.className = 'nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 bg-[#FF6B35] text-white shadow-sm';
                } else if (navTarget !== 'galeri') {
                    item.className = 'nav-item px-4 py-1.5 rounded-full text-xs font-semibold transition-all duration-200 text-slate-300 hover:text-white hover:bg-slate-800/60';
                }
            });

            mobileItems.forEach(item => {
                const navTarget = item.getAttribute('data-nav');
                if (navTarget === targetId) {
                    item.className = 'nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold bg-[#FF6B35] text-white';
                } else if (navTarget !== 'galeri') {
                    item.className = 'nav-item-mobile block px-3 py-2 rounded-lg text-xs font-semibold text-slate-300 hover:bg-slate-800';
                }
            });
        }

        // Scrollspy calculation
        function onScrollSpy() {
            // Only run on landing page with sections present
            if (!document.getElementById('home')) return;

            const scrollY = window.scrollY;
            const navbarOffset = 120; // Trigger threshold
            let current = 'home';

            sections.forEach(sec => {
                if (sec.element) {
                    const top = sec.element.offsetTop - navbarOffset;
                    const height = sec.element.offsetHeight;
                    if (scrollY >= top && scrollY < top + height) {
                        current = sec.id;
                    }
                }
            });

            // If at bottom of page, activate the last section (kegiatan)
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                current = 'kegiatan';
            }

            setActiveNav(current);
        }

        window.addEventListener('scroll', onScrollSpy, { passive: true });
        onScrollSpy(); // Trigger immediately on load

        // Handle direct clicks on links
        [...desktopItems, ...mobileItems].forEach(link => {
            const nav = link.getAttribute('data-nav');
            if (nav && nav !== 'galeri') {
                link.addEventListener('click', function(e) {
                    const targetEl = document.getElementById(nav);
                    if (targetEl) {
                        e.preventDefault();
                        const top = targetEl.offsetTop - 70;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                        setActiveNav(nav);
                    }
                });
            }
        });
    });
</script>
