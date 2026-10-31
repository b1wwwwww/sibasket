<x-public-layout :title="'KOMET Basketball Club - SIBASKET'">
    <!-- ==========================================
         1. HERO SECTION WITH OSMO PARALLAX SCROLL
    =========================================== -->
    <section id="home" class="relative bg-[#070E1A] text-white min-h-[100vh] flex flex-col justify-between overflow-hidden">
        <!-- Parallax Visuals & Layers Container -->
        <div data-parallax-layers class="relative w-full h-[100vh] min-h-[700px] overflow-hidden flex flex-col justify-between">
            <!-- Layer 1: Background Lapangan Basket (yPercent: 70) -->
            <img src="{{ asset('images/lapangan.jpeg') }}" 
                 data-parallax-layer="1" 
                 loading="eager" 
                 alt="Lapangan Basket SMKN 1 Katapang" 
                 class="absolute inset-0 w-full h-[135%] -top-[15%] object-cover object-center filter brightness-[0.45] contrast-[1.15] select-none pointer-events-none will-change-transform" />

            <!-- Layer 2: Atmosphere & Ambient Glow Overlay (yPercent: 55) -->
            <div data-parallax-layer="2" class="absolute inset-0 w-full h-full bg-gradient-to-t from-[#070E1A] via-transparent to-[#070E1A]/80 pointer-events-none select-none will-change-transform z-10"></div>

            <!-- Layer 3: Massive 3D Depth Typography (Behind Team Cutout) (yPercent: 40) -->
            <div data-parallax-layer="3" class="absolute inset-0 flex items-center justify-center pointer-events-none select-none z-20 will-change-transform">
                <h2 class="text-[16vw] font-black uppercase text-white/[0.88] tracking-tighter drop-shadow-[0_15px_35px_rgba(0,0,0,0.85)] select-none leading-none translate-y-16 md:translate-y-20">
                    KOMET
                </h2>
            </div>

            <!-- Layer 4: Foreground Cutout of Team Players (In Front of Typography) (yPercent: 10) -->
            <div data-parallax-layer="4" class="absolute bottom-0 inset-x-0 flex justify-center pointer-events-none z-30 will-change-transform">
                <img src="{{ asset('images/tim-komet-cutout.png') }}" 
                     loading="eager" 
                     alt="Tim Basket KOMET SMKN 1 Katapang" 
                     class="max-h-[60vh] sm:max-h-[72vh] md:max-h-[78vh] object-contain object-bottom filter drop-shadow-[0_20px_45px_rgba(0,0,0,0.95)] contrast-[1.05]" />
            </div>

            <!-- Parallax Bottom Fade Transition into About section -->
            <div class="absolute bottom-0 inset-x-0 h-44 bg-gradient-to-t from-[#FAF9F6] via-[#FAF9F6]/60 to-transparent z-40 pointer-events-none"></div>

            <!-- Top Hero Overlay Content (Badge, Headline & Subtitle) -->
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-50 pt-8 sm:pt-10 md:pt-12">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#070E1A]/85 border border-orange-500/50 text-orange-400 text-xs font-semibold mb-3 shadow-lg backdrop-blur-md animate-fade-in-up">
                    <span>🔥 Pendaftaran Gelombang 2026 Dibuka!</span>
                    <i class="fas fa-chevron-right text-[9px]"></i>
                </div>

                <!-- Main Headline -->
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-[1.15] mb-3 max-w-2xl drop-shadow-xl">
                    KOMET: Lebih Dari Sekadar<br class="hidden sm:inline" />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-[#FF8C5A]">Tim, Kita Adalah Keluarga</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-slate-200 text-xs sm:text-sm max-w-xl leading-relaxed drop-shadow-md">
                    Mencetak atlet berprestasi dan membangun karakter melalui basket di SMKN 1 Katapang dengan kurikulum terpadu, kedisiplinan tinggi, dan semangat persaudaraan tanpa batas.
                </p>
            </div>

            <!-- Scroll Down Prompt at the Bottom -->
            <div class="relative z-50 text-center pb-6">
                <a href="#tentang-kami" onclick="event.preventDefault(); document.getElementById('tentang-kami')?.scrollIntoView({behavior: 'smooth'});" class="inline-flex flex-col items-center text-slate-700 hover:text-[#FF6B35] transition text-[10px] font-bold tracking-widest uppercase">
                    <span class="mb-1">Scroll Down To Explore</span>
                    <i class="fas fa-chevron-down animate-bounce text-xs"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ==========================================
         2. FILOSOFI & NILAI KOMET SECTION (ABOUT US)
    =========================================== -->
    <section id="tentang-kami" class="w-full py-24 px-4 bg-gradient-to-b from-[#FAF9F6] to-[#F3F4F6] text-[#1F3A5F] overflow-hidden relative">
        <!-- Floating Subtle Circles Background -->
        <div class="absolute top-20 left-10 w-72 h-72 rounded-full bg-[#FF6B35]/5 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 rounded-full bg-[#1F3A5F]/5 blur-3xl pointer-events-none"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <!-- Header Section -->
            <div class="flex flex-col items-center mb-6 text-center">
                <span class="text-[#FF6B35] font-bold text-xs tracking-widest uppercase flex items-center gap-2 mb-2">
                    <i class="fas fa-bolt text-xs"></i> DISCOVER OUR STORY
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0B1728] tracking-tight mb-3">
                    Filosofi & Nilai KOMET
                </h2>
                <!-- Accent Line -->
                <div class="w-24 h-1 bg-[#FF6B35] rounded-full mb-6"></div>
                <p class="text-xs sm:text-sm text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Ekstrakurikuler bola basket KOMET di SMKN 1 Katapang menjadi wadah sinergi, persaudaraan, dan pembinaan karakter seluruh siswa lintas kompetensi keahlian—menyatukan keragaman kejuruan menjadi kekuatan juara di dalam dan luar lapangan.
                </p>
            </div>

            <!-- 3-Column Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center mt-12 mb-16">
                <!-- LEFT COLUMN: Jurusan/Nilai 1, 2, 3 -->
                <div class="space-y-10">
                    <!-- Item 1: Komputer -->
                    <div class="flex flex-col group transition-transform duration-200 hover:-translate-y-1">
                        <div class="flex items-center gap-3.5 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-[#FF6B35]/10 text-[#FF6B35] flex items-center justify-center text-lg relative group-hover:bg-[#FF6B35]/20 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                <i class="fas fa-laptop-code"></i>
                                <i class="fas fa-sparkles text-[9px] text-amber-500 absolute -top-1 -right-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors">
                                    Komputer
                                </h3>
                                <span class="text-[10px] font-semibold text-orange-700 bg-orange-100/80 px-2 py-0.5 rounded-full inline-block">
                                    Jaringan & Aplikasi
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed pl-[60px]">
                            Mencakup jurusan RPL, TKJ, dan BP. Melatih atlet berpikir cepat, analitis dalam membaca taktik lawan, serta pemanfaatan rekaman data digital pertandingan.
                        </p>
                    </div>

                    <!-- Item 2: Otomotif -->
                    <div class="flex flex-col group transition-transform duration-200 hover:-translate-y-1">
                        <div class="flex items-center gap-3.5 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center text-lg relative group-hover:bg-blue-500/20 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                <i class="fas fa-car-side"></i>
                                <i class="fas fa-check-circle text-[9px] text-blue-500 absolute -top-1 -right-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#0B1728] group-hover:text-blue-600 transition-colors">
                                    Otomotif
                                </h3>
                                <span class="text-[10px] font-semibold text-blue-700 bg-blue-100/80 px-2 py-0.5 rounded-full inline-block">
                                    Ketahanan & Kecepatan
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed pl-[60px]">
                            Mencakup jurusan Teknik Otomotif. Menanamkan stamina prima tanpa henti, kedisiplinan mekanik yang presisi, dan daya pacu tinggi di lapangan dengan etos kerja tak kenal lelah.
                        </p>
                    </div>

                    <!-- Item 3: Karakter & Disiplin -->
                    <div class="flex flex-col group transition-transform duration-200 hover:-translate-y-1">
                        <div class="flex items-center gap-3.5 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center text-lg relative group-hover:bg-amber-500/20 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                <i class="fas fa-shield-alt"></i>
                                <i class="fas fa-star text-[9px] text-amber-500 absolute -top-1 -right-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#0B1728] group-hover:text-amber-600 transition-colors">
                                    Disiplin & Integritas
                                </h3>
                                <span class="text-[10px] font-semibold text-amber-700 bg-amber-100/80 px-2 py-0.5 rounded-full inline-block">
                                    Mental Juara
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed pl-[60px]">
                            Menjunjung tinggi sportivitas, sikap saling menghargai antarpemain, dan konsistensi kehadiran latihan sebagai cerminan karakter unggul pelajar.
                        </p>
                    </div>
                </div>

                <!-- CENTER COLUMN: Modern Portrait Image with Double Border Offset -->
                <div class="flex justify-center items-center order-first md:order-none mb-8 md:mb-0">
                    <div class="relative w-full max-w-xs group">
                        <!-- Outer Decorative Frame Offset -->
                        <div class="absolute inset-0 border-4 border-[#FF6B35]/40 rounded-2xl -m-3.5 z-0 transition-transform duration-300 group-hover:scale-105"></div>
                        
                        <!-- Floating Accent Circle Badges -->
                        <div class="absolute -top-4 -right-4 w-12 h-12 rounded-full bg-[#FF6B35]/20 blur-md pointer-events-none"></div>
                        <div class="absolute -bottom-4 -left-4 w-14 h-14 rounded-full bg-[#1F3A5F]/25 blur-md pointer-events-none"></div>

                        <!-- Main Image Container -->
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-200/80 aspect-[3/4] z-10 bg-slate-900">
                            <img src="{{ asset('images/about-team.jpg') }}" 
                                 alt="KOMET Team SMKN 1 Katapang" 
                                 class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                            
                            <!-- Bottom Overlay Card -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0B1728]/90 via-[#0B1728]/30 to-transparent flex flex-col justify-end p-5 text-center">
                                <span class="text-[11px] font-bold tracking-widest text-orange-400 uppercase mb-0.5">SMKN 1 KATAPANG</span>
                                <h4 class="text-white font-black text-sm tracking-wide mb-3">KOMET BASKETBALL CLUB</h4>
                                <a href="{{ route('gallery.index') }}" 
                                   class="bg-white/95 hover:bg-[#FF6B35] hover:text-white text-[#0B1728] px-4 py-2 rounded-full text-xs font-bold shadow-md inline-flex items-center justify-center gap-1.5 transition mx-auto">
                                    <span>Galeri Tim</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Jurusan/Nilai 4, 5, 6 -->
                <div class="space-y-10">
                    <!-- Item 4: Mesin -->
                    <div class="flex flex-col group transition-transform duration-200 hover:-translate-y-1">
                        <div class="flex items-center gap-3.5 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-600 flex items-center justify-center text-lg relative group-hover:bg-orange-500/20 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                <i class="fas fa-cogs"></i>
                                <i class="fas fa-sparkles text-[9px] text-orange-500 absolute -top-1 -right-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#0B1728] group-hover:text-orange-600 transition-colors">
                                    Mesin
                                </h3>
                                <span class="text-[10px] font-semibold text-orange-700 bg-orange-100/80 px-2 py-0.5 rounded-full inline-block">
                                    Presisi & Kekuatan
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed pl-[60px]">
                            Mencakup jurusan Teknik Mesin. Membangun postur fisik kokoh, pertahanan kokoh tanpa celah, serta akurasi shooting yang terkalibrasi presisi.
                        </p>
                    </div>

                    <!-- Item 5: Elektro -->
                    <div class="flex flex-col group transition-transform duration-200 hover:-translate-y-1">
                        <div class="flex items-center gap-3.5 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center text-lg relative group-hover:bg-indigo-500/20 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                <i class="fas fa-bolt"></i>
                                <i class="fas fa-check-circle text-[9px] text-indigo-500 absolute -top-1 -right-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#0B1728] group-hover:text-indigo-600 transition-colors">
                                    Elektro
                                </h3>
                                <span class="text-[10px] font-semibold text-indigo-700 bg-indigo-100/80 px-2 py-0.5 rounded-full inline-block">
                                    Responsif & Sinergi
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed pl-[60px]">
                            Mencakup TITL & Elektronika. Refleks instan, rotasi bola berkecepatan tinggi, dan keterhubungan (konektivitas) tim bagai arus listrik tanpa jeda.
                        </p>
                    </div>

                    <!-- Item 6: Tekstil -->
                    <div class="flex flex-col group transition-transform duration-200 hover:-translate-y-1">
                        <div class="flex items-center gap-3.5 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-rose-500/10 text-rose-600 flex items-center justify-center text-lg relative group-hover:bg-rose-500/20 group-hover:rotate-6 transition-all duration-300 flex-shrink-0">
                                <i class="fas fa-cut"></i>
                                <i class="fas fa-star text-[9px] text-rose-500 absolute -top-1 -right-1"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#0B1728] group-hover:text-rose-600 transition-colors">
                                    Tekstil
                                </h3>
                                <span class="text-[10px] font-semibold text-rose-700 bg-rose-100/80 px-2 py-0.5 rounded-full inline-block">
                                    Fleksibilitas & Kreativitas
                                </span>
                            </div>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed pl-[60px]">
                            Mencakup jurusan Teknik Tekstil. Merajut kekompakan tim yang lentur menghadapi ragam skema lawan, menyatukan rasa kekeluargaan erat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Section (Matching Reference Component: Circle Icon + Big Count + Bottom Bar) -->
            <div class="mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat 1: 50+ Anggota Aktif -->
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col items-center text-center group hover:bg-white hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-[#1F3A5F]/5 flex items-center justify-center mb-3 text-[#FF6B35] group-hover:bg-[#FF6B35]/10 group-hover:rotate-12 transition-all duration-300 text-xl">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="text-3xl font-black text-[#0B1728]">50+</div>
                    <p class="text-slate-600 text-xs font-semibold mt-1">Anggota Aktif</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Siswa SMKN 1 Katapang</p>
                    <div class="w-10 h-0.5 bg-[#FF6B35] mt-3 group-hover:w-16 transition-all duration-300"></div>
                </div>

                <!-- Stat 2: 1+ Pelatih & Pembina (Updated to 1+) -->
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col items-center text-center group hover:bg-white hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-[#1F3A5F]/5 flex items-center justify-center mb-3 text-[#FF6B35] group-hover:bg-[#FF6B35]/10 group-hover:rotate-12 transition-all duration-300 text-xl">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="text-3xl font-black text-[#0B1728]">1+</div>
                    <p class="text-slate-600 text-xs font-semibold mt-1">Pelatih & Pembina</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Lisensi PERBASI & Guru</p>
                    <div class="w-10 h-0.5 bg-[#FF6B35] mt-3 group-hover:w-16 transition-all duration-300"></div>
                </div>

                <!-- Stat 3: 3x Latihan Terstruktur -->
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col items-center text-center group hover:bg-white hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-[#1F3A5F]/5 flex items-center justify-center mb-3 text-[#FF6B35] group-hover:bg-[#FF6B35]/10 group-hover:rotate-12 transition-all duration-300 text-xl">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="text-3xl font-black text-[#0B1728]">3x</div>
                    <p class="text-slate-600 text-xs font-semibold mt-1">Latihan Terstruktur</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Fundamental, Fisik & Taktik</p>
                    <div class="w-10 h-0.5 bg-[#FF6B35] mt-3 group-hover:w-16 transition-all duration-300"></div>
                </div>

                <!-- Stat 4: 98% Tingkat Solidaritas -->
                <div class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col items-center text-center group hover:bg-white hover:shadow-md transition-all duration-300">
                    <div class="w-14 h-14 rounded-full bg-[#1F3A5F]/5 flex items-center justify-center mb-3 text-[#FF6B35] group-hover:bg-[#FF6B35]/10 group-hover:rotate-12 transition-all duration-300 text-xl">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="text-3xl font-black text-[#0B1728]">98%</div>
                    <p class="text-slate-600 text-xs font-semibold mt-1">Tingkat Solidaritas</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">Karakter & Loyalitas Alumni</p>
                    <div class="w-10 h-0.5 bg-[#FF6B35] mt-3 group-hover:w-16 transition-all duration-300"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         3. PRESTASI & TIMELINE SECTION (WITH SCROLL PROGRESS DRAWING LINE)
    =========================================== -->
    <section id="prestasi" class="py-24 bg-white text-[#0B1728] relative overflow-hidden border-t border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-5xl font-black text-[#0B1728] tracking-tight mb-2">
                    Our Journey
                </h2>
                <p class="text-xs font-mono font-bold tracking-widest text-[#FF6B35] uppercase mb-4">
                    SCROLL DOWN TO EXPLORE ↓
                </p>
                <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto leading-relaxed">
                    Rekam jejak perjuangan dan piala kebanggaan klub dari panggung regional hingga kancah kompetisi pelajar nasional.
                </p>
            </div>

            <!-- Vertical Timeline with Scroll Progress Drawing Line -->
            <div id="timeline-interactive-container" class="relative">
                <!-- Background faded line -->
                <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-[2px] bg-slate-200 -translate-x-1/2"></div>
                
                <!-- Animated foreground line (draws down on scroll) -->
                <div id="timeline-progress-line" 
                     class="absolute left-4 md:left-1/2 top-0 w-[2px] bg-[#FF6B35] -translate-x-1/2 transition-all duration-100 ease-out z-0"
                     style="height: 0%;"></div>

                <div class="flex flex-col gap-14 md:gap-20 relative z-10">
                    <!-- MILESTONE 1: Bandung Selatan Basketball League 2023 -->
                    <div class="timeline-milestone relative flex flex-col md:flex-row items-start w-full group" data-index="0">
                        <!-- Node Dot -->
                        <div class="timeline-dot absolute left-4 md:left-1/2 top-0 w-4 h-4 rounded-full border-2 -translate-x-1/2 mt-1.5 transition-all duration-500 z-20 border-slate-300 bg-white"></div>

                        <!-- Content Card (Left on Desktop) -->
                        <div class="timeline-card w-full md:w-1/2 pl-12 md:pl-0 md:pr-12 md:text-right transition-all duration-700 ease-out opacity-100 translate-y-0">
                            <div class="flex flex-wrap items-center md:justify-end gap-2 mb-2.5">
                                <span class="inline-block px-3 py-1 rounded-full border border-orange-200 bg-orange-50 text-xs font-mono tracking-widest text-[#FF6B35] font-bold">
                                    🏆 TAHUN 2023
                                </span>
                                <span class="inline-block px-2.5 py-0.5 rounded-full border border-amber-200 bg-amber-100 text-xs font-semibold text-amber-800">
                                    <strong>Juara 3</strong> (Putra & Putri)
                                </span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-[#0B1728]">
                                <strong>Juara 3</strong> Bandung Selatan Basketball League
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600 mb-4">
                                Prestasi membanggakan tim basket KOMET SMKN 1 Katapang di ajang Bandung Selatan Basketball League 2023, di mana tim putra dan tim putri sukses mengawinkan gelar <strong>Juara 3</strong> bersama.
                            </p>
                            <div class="rounded-xl overflow-hidden shadow-md border border-slate-200/80 inline-block max-w-sm">
                                <img src="{{ asset('images/prestasi-bsbl-2023.webp') }}" 
                                     alt="Juara 3 Bandung Selatan Basketball League 2023" 
                                     class="w-full h-44 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>

                        <!-- Desktop Empty Space -->
                        <div class="hidden md:block w-1/2"></div>
                    </div>

                    <!-- MILESTONE 2: O2SN Kabupaten Bandung 2024 -->
                    <div class="timeline-milestone relative flex flex-col md:flex-row md:flex-row-reverse items-start w-full group" data-index="1">
                        <!-- Node Dot -->
                        <div class="timeline-dot absolute left-4 md:left-1/2 top-0 w-4 h-4 rounded-full border-2 -translate-x-1/2 mt-1.5 transition-all duration-500 z-20 border-slate-300 bg-white"></div>

                        <!-- Content Card (Right on Desktop) -->
                        <div class="timeline-card w-full md:w-1/2 pl-12 md:pl-12 md:text-left transition-all duration-700 ease-out opacity-100 translate-y-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2.5">
                                <span class="inline-block px-3 py-1 rounded-full border border-blue-200 bg-blue-50 text-xs font-mono tracking-widest text-blue-600 font-bold">
                                    🥈 TAHUN 2024
                                </span>
                                <span class="inline-block px-2.5 py-0.5 rounded-full border border-blue-200 bg-blue-100 text-xs font-semibold text-blue-800">
                                    <strong>Juara 2</strong> (Tim Putra)
                                </span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-[#0B1728]">
                                <strong>Juara 2</strong> O2SN Se-Kabupaten Bandung
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600 mb-4">
                                Perjuangan impresif tim putra KOMET SMKN 1 Katapang di ajang Olimpiade Olahraga Siswa Nasional (O2SN) jenjang SMK se-Kabupaten Bandung 2024 berhasil meraih posisi Runner Up / <strong>Juara 2</strong>.
                            </p>
                            <div class="rounded-xl overflow-hidden shadow-md border border-slate-200/80 inline-block max-w-sm">
                                <img src="{{ asset('images/prestasi-o2sn-2024.webp') }}" 
                                     alt="Juara 2 O2SN Se-Kabupaten Bandung 2024" 
                                     class="w-full h-44 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>

                        <!-- Desktop Empty Space -->
                        <div class="hidden md:block w-1/2"></div>
                    </div>

                    <!-- MILESTONE 3: Budi Bakti Champions 2024 -->
                    <div class="timeline-milestone relative flex flex-col md:flex-row items-start w-full group" data-index="2">
                        <!-- Node Dot -->
                        <div class="timeline-dot absolute left-4 md:left-1/2 top-0 w-4 h-4 rounded-full border-2 -translate-x-1/2 mt-1.5 transition-all duration-500 z-20 border-slate-300 bg-white"></div>

                        <!-- Content Card (Left on Desktop) -->
                        <div class="timeline-card w-full md:w-1/2 pl-12 md:pl-0 md:pr-12 md:text-right transition-all duration-700 ease-out opacity-100 translate-y-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2.5 md:justify-end">
                                <span class="inline-block px-3 py-1 rounded-full border border-yellow-300 bg-yellow-50 text-xs font-mono tracking-widest text-yellow-700 font-bold">
                                    🏆 TAHUN 2024
                                </span>
                                <span class="inline-block px-2.5 py-0.5 rounded-full border border-yellow-300 bg-yellow-100 text-xs font-semibold text-yellow-800">
                                    <strong>Juara 1</strong> Putra · <strong>Juara 2</strong> Putri
                                </span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-[#0B1728]">
                                Juara Budi Bakti Champions
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600 mb-4">
                                Menutup tahun 2024 dengan gemilang! Tim Putra KOMET SMKN 1 Katapang meraih <strong>Juara 1</strong> dan Tim Putri meraih <strong>Juara 2</strong> di ajang Kejuaraan Budi Bakti Champions. Bukti nyata konsistensi KOMET di setiap arena.
                            </p>
                            <div class="rounded-xl overflow-hidden shadow-md border border-slate-200/80 inline-block max-w-sm">
                                <img src="{{ asset('images/prestasi-budi-bakti-2024.jpg') }}"
                                     alt="Juara Budi Bakti Champions 2024 - Tim Putra Juara 1 & Tim Putri Juara 2"
                                     class="w-full h-44 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        </div>

                        <!-- Desktop Empty Space -->
                        <div class="hidden md:block w-1/2"></div>
                    </div>

                    <!-- MILESTONE 4: BUBACI LEAGUE 2025 -->
                    <div class="timeline-milestone relative flex flex-col md:flex-row md:flex-row-reverse items-start w-full group" data-index="3">
                        <!-- Node Dot -->
                        <div class="timeline-dot absolute left-4 md:left-1/2 top-0 w-4 h-4 rounded-full border-2 -translate-x-1/2 mt-1.5 transition-all duration-500 z-20 border-slate-300 bg-white"></div>

                        <!-- Content Card (Right on Desktop) -->
                        <div class="timeline-card w-full md:w-1/2 pl-12 md:pl-12 md:text-left transition-all duration-700 ease-out opacity-100 translate-y-0">
                            <div class="flex flex-wrap items-center gap-2 mb-2.5">
                                <span class="inline-block px-3 py-1 rounded-full border border-violet-200 bg-violet-50 text-xs font-mono tracking-widest text-violet-700 font-bold">
                                    🏆 TAHUN 2025
                                </span>
                                <span class="inline-block px-2.5 py-0.5 rounded-full border border-violet-200 bg-violet-100 text-xs font-semibold text-violet-800">
                                    <strong>Juara 3</strong> Putra & Putri
                                </span>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold tracking-tight text-[#0B1728]">
                                <strong>Juara 3</strong> Bubaci League Se-Jawa Barat
                            </h3>
                            <p class="mt-2 text-xs sm:text-sm leading-relaxed text-slate-600 mb-4">
                                Tim putra dan putri Eskul Basket SMKN 1 Katapang berhasil menorehkan prestasi membanggakan di ajang Bubaci League 2025 dengan meraih <strong>Juara 3</strong> se-Jawa Barat.
                            </p>
                            <div class="grid grid-cols-3 gap-2 max-w-lg">
                                <div class="rounded-xl overflow-hidden shadow-md border border-slate-200/80">
                                    <img src="{{ asset('images/bubaci-league.jpeg') }}" alt="Bubaci League 2025" class="w-full h-32 object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="rounded-xl overflow-hidden shadow-md border border-slate-200/80">
                                    <img src="{{ asset('images/bubaci-2.jpeg') }}" alt="Juara 3 Bubaci League 2025 - Tim putri" class="w-full h-32 object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="rounded-xl overflow-hidden shadow-md border border-slate-200/80">
                                    <img src="{{ asset('images/bubaci-1.jpeg') }}" alt="Juara 3 Bubaci League 2025 - Tim putra" class="w-full h-32 object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            </div>
                        </div>

                        <!-- Desktop Empty Space -->
                        <div class="hidden md:block w-1/2"></div>
                    </div>

                </div>
            </div>

            <!-- Bottom Journey Closing -->
            <div class="mt-16 rounded-3xl border border-orange-200 bg-gradient-to-r from-orange-50 via-white to-orange-50 px-6 py-8 text-center shadow-sm">
                <p class="text-[10px] sm:text-xs font-black tracking-[0.28em] uppercase text-[#FF6B35] mb-2">
                    Journey continues
                </p>
                <h3 class="text-xl sm:text-3xl font-black text-[#0B1728] tracking-tight mb-2">
                    Perjalanan masih panjang.
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Masih banyak kejuaraan yang harus kami menangkan, dan kami akan terus berjuang bersama untuk membawa nama SMKN 1 Katapang lebih tinggi di kancah basket.
                </p>
                <div class="mt-4 text-[#FF6B35] text-xs font-black tracking-[0.18em] uppercase">
                    #satuuntukkatapang
                </div>
            </div>

            <!-- Bottom Link -->
            <div class="text-center mt-10">
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 hover:bg-[#FF6B35] text-white text-xs font-bold rounded-full transition shadow-md">
                    <span>Lihat Seluruh Galeri Trofi & Rekap Pertandingan</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ==========================================
         4. JADWAL LATIHAN RUTIN SECTION (NEW)
    =========================================== -->
    <section id="jadwal-latihan" class="py-24 bg-white text-[#0B1728]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <span class="text-[#FF6B35] text-[11px] font-extrabold tracking-widest uppercase flex items-center justify-center gap-2 mb-2">
                    <i class="fas fa-dumbbell"></i> JADWAL TETAP
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-[#0B1728] tracking-tight mb-4">
                    📅 Jadwal Latihan Rutin
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 max-w-2xl mx-auto">
                    Tetap komitmen! Berikut adalah jadwal latihan basket rutin KOMET setiap minggunya.
                </p>
            </div>

            <!-- Grid Jadwal Latihan (3 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $jadwalLatihan = \App\Models\JadwalLatihan::aktif()->get();
                    $warnaBorder = [
                        'selasa' => 'border-blue-500 bg-blue-50',
                        'jumat' => 'border-purple-500 bg-purple-50',
                        'sabtu' => 'border-green-500 bg-green-50',
                    ];
                    $warnaBadge = [
                        'selasa' => 'bg-blue-100 text-blue-800',
                        'jumat' => 'bg-purple-100 text-purple-800',
                        'sabtu' => 'bg-green-100 text-green-800',
                    ];
                    $warnaTipeLokasi = [
                        'indoor' => 'bg-indigo-100 text-indigo-800',
                        'outdoor' => 'bg-amber-100 text-amber-800',
                    ];
                @endphp

                @forelse($jadwalLatihan as $jadwal)
                    <div class="border-l-4 {{ $warnaBorder[$jadwal->hari] ?? 'border-slate-300 bg-slate-50' }} rounded-lg p-6 shadow-md hover:shadow-lg transition">
                        <!-- Hari -->
                        <h3 class="text-lg font-black text-[#0B1728] capitalize mb-4">
                            {{ $jadwal->hari }}
                        </h3>

                        <!-- Jam -->
                        <div class="mb-4 flex items-start gap-2">
                            <i class="fas fa-clock text-[#FF6B35] text-lg mt-0.5"></i>
                            <div>
                                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Jam Latihan</p>
                                <p class="text-base font-bold text-[#0B1728]">
                                    {{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }} WIB
                                </p>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-4 flex items-start gap-2">
                            <i class="fas fa-map-marker-alt text-[#FF6B35] text-lg mt-0.5"></i>
                            <div>
                                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Lokasi</p>
                                <p class="text-base font-bold text-[#0B1728]">{{ $jadwal->lokasi }}</p>
                            </div>
                        </div>

                        <!-- Tipe Lokasi Badge -->
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold capitalize {{ $warnaTipeLokasi[$jadwal->tipe_lokasi] ?? 'bg-slate-100 text-slate-800' }}">
                            <i class="fas {{ $jadwal->tipe_lokasi == 'indoor' ? 'fa-building' : 'fa-tree' }} mr-1"></i>
                            {{ $jadwal->tipe_lokasi }}
                        </span>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-slate-500 text-sm">Jadwal latihan akan segera diumumkan</p>
                    </div>
                @endforelse
            </div>

            <!-- Info Tambahan -->
            <div class="mt-12 text-center bg-gradient-to-r from-[#FF6B35]/10 to-[#FF8C5A]/10 rounded-lg p-6 border border-[#FF6B35]/20">
                <p class="text-xs sm:text-sm text-slate-700">
                    <i class="fas fa-info-circle text-[#FF6B35] mr-2"></i>
                    <strong>Jangan sampai ketinggalan!</strong> Latihan rutin adalah kunci kesuksesan kami. Pastikan kamu hadir tepat waktu setiap jadwalnya.
                </p>
            </div>
        </div>
    </section>

    <!-- ==========================================
         5. INFO TERKINI & KEGIATAN SECTION (ENHANCED VISUAL WITH IMAGES)
    =========================================== -->
    <section id="kegiatan" class="py-24 bg-slate-50 text-[#0B1728] border-t border-slate-200/80">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Row with title on left and link on right -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-[#FF6B35] text-[11px] font-extrabold tracking-widest uppercase flex items-center gap-2">
                        <i class="fas fa-newspaper"></i> AGENDA & BERITA TERKINI
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-[#0B1728] mt-1 tracking-tight">
                        Info Terkini & Kegiatan
                    </h2>
                </div>
                <a href="{{ route('kegiatan.publik') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-1.5 text-xs font-bold text-[#1F3A5F] hover:text-[#FF6B35] transition">
                    <span>Pusat Informasi Lengkap</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <!-- 2-Column Grid: Kegiatan Mendatang (Left) & Pengumuman Terbaru (Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- LEFT COLUMN: KEGIATAN MENDATANG -->
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-base font-bold text-[#0B1728] flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-[#FF6B35]"></i>
                            <span>Kegiatan Mendatang</span>
                        </h3>
                        <span class="text-[10px] font-bold text-slate-400 bg-slate-200/70 px-2 py-0.5 rounded-full uppercase">Jadwal Mingguan</span>
                    </div>

                    <div class="space-y-4">
                        @if(isset($kegiatan) && $kegiatan->isNotEmpty())
                            @foreach($kegiatan as $keg)
                                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row group">
                                    <!-- Thumbnail Image -->
                                    <div class="sm:w-36 h-36 sm:h-auto relative bg-slate-800 flex-shrink-0 overflow-hidden">
                                        @if($keg->foto)
                                            <img src="{{ asset('storage/' . $keg->foto) }}" alt="{{ $keg->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <img src="{{ asset('images/lapangan.jpeg') }}" alt="{{ $keg->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @endif
                                        <span class="absolute top-2 left-2 text-[9px] font-bold text-white bg-black/60 backdrop-blur-sm px-2 py-0.5 rounded-full">
                                            {{ ucfirst($keg->status ?? 'Terbuka') }}
                                        </span>
                                    </div>
                                    <!-- Content -->
                                    <div class="p-4 flex flex-col justify-between flex-grow">
                                        <div>
                                            <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1 mb-1">
                                                <i class="far fa-clock text-orange-500"></i> {{ \Carbon\Carbon::parse($keg->tanggal)->translatedFormat('l, d M Y • H:i') }} WIB
                                            </span>
                                            <h4 class="text-sm font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors line-clamp-1 mb-1">
                                                {{ $keg->judul }}
                                            </h4>
                                            <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed mb-3">
                                                {{ $keg->deskripsi ?? 'Kegiatan resmi klub basket KOMET SMKN 1 Katapang.' }}
                                            </p>
                                        </div>
                                        <div class="text-[11px] text-slate-500 flex items-center gap-1.5 pt-2 border-t border-slate-100">
                                            <i class="fas fa-map-marker-alt text-red-500"></i>
                                            <span class="line-clamp-1">{{ $keg->lokasi }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback Mock Kegiatan 1 -->
                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row group">
                                <div class="sm:w-36 h-36 sm:h-auto relative bg-slate-800 flex-shrink-0 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1519766304817-4f37bda74a29?auto=format&fit=crop&w=400&q=80" alt="Latihan Rutin" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-2 left-2 text-[9px] font-bold text-white bg-green-600/90 backdrop-blur-sm px-2 py-0.5 rounded-full">
                                        Terbuka
                                    </span>
                                </div>
                                <div class="p-4 flex flex-col justify-between flex-grow">
                                    <div>
                                        <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1 mb-1">
                                            <i class="far fa-clock text-orange-500"></i> Setiap Senin • 15:30 WIB
                                        </span>
                                        <h4 class="text-sm font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors mb-1">
                                            Latihan Rutin Senin
                                        </h4>
                                        <p class="text-xs text-slate-600 leading-relaxed mb-3">
                                            Drill fundamental passing, shooting form, dan fastbreak transition di bawah bimbingan Head Coach.
                                        </p>
                                    </div>
                                    <div class="text-[11px] text-slate-500 flex items-center gap-1.5 pt-2 border-t border-slate-100">
                                        <i class="fas fa-map-marker-alt text-red-500"></i>
                                        <span>Lapangan Indoor KOMET Baxter</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Fallback Mock Kegiatan 2 -->
                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row group">
                                <div class="sm:w-36 h-36 sm:h-auto relative bg-slate-800 flex-shrink-0 overflow-hidden">
                                    <img src="{{ asset('images/tim-komet.jpeg') }}" alt="Latihan Taktik Tim" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-2 left-2 text-[9px] font-bold text-white bg-sky-600/90 backdrop-blur-sm px-2 py-0.5 rounded-full">
                                        Rutin
                                    </span>
                                </div>
                                <div class="p-4 flex flex-col justify-between flex-grow">
                                    <div>
                                        <span class="text-[10px] text-slate-500 font-medium flex items-center gap-1 mb-1">
                                            <i class="far fa-calendar text-orange-500"></i> Kamis • 16:00 WIB
                                        </span>
                                        <h4 class="text-sm font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors mb-1">
                                            Latihan Taktik & Conditioning
                                        </h4>
                                        <p class="text-xs text-slate-600 leading-relaxed mb-3">
                                            Fokus pada pola menyerang, rotasi pemain, dan kesiapan fisik menjelang kompetisi berikutnya.
                                        </p>
                                    </div>
                                    <div class="text-[11px] text-slate-500 flex items-center gap-1.5 pt-2 border-t border-slate-100">
                                        <i class="fas fa-map-marker-alt text-red-500"></i>
                                        <span>Lapangan SMKN 1 Katapang</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT COLUMN: PENGUMUMAN TERBARU -->
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-base font-bold text-[#0B1728] flex items-center gap-2">
                            <i class="fas fa-bullhorn text-[#FF6B35]"></i>
                            <span>Pengumuman Terbaru</span>
                        </h3>
                        <span class="text-[10px] font-bold text-slate-400 bg-slate-200/70 px-2 py-0.5 rounded-full uppercase">Official Notice</span>
                    </div>

                    <div class="space-y-4">
                        @if(isset($pengumuman) && $pengumuman->isNotEmpty())
                            @foreach($pengumuman as $peng)
                                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row group">
                                    <!-- Image Thumbnail -->
                                    <div class="sm:w-36 h-36 sm:h-auto relative bg-slate-800 flex-shrink-0 overflow-hidden">
                                        @if($peng->foto)
                                            <img src="{{ asset('storage/' . $peng->foto) }}" alt="{{ $peng->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <img src="{{ asset('images/about-team.jpg') }}" alt="{{ $peng->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @endif
                                        @if($peng->is_pinned)
                                            <span class="absolute top-2 left-2 text-[9px] font-bold text-white bg-amber-500 px-2 py-0.5 rounded-full">
                                                📌 Pinned
                                            </span>
                                        @endif
                                    </div>
                                    <!-- Text Content -->
                                    <div class="p-4 flex flex-col justify-between flex-grow">
                                        <div>
                                            <span class="text-[10px] text-slate-400 font-medium flex items-center gap-1 mb-1">
                                                <i class="far fa-calendar-alt text-slate-400"></i> {{ \Carbon\Carbon::parse($peng->tanggal_publish)->translatedFormat('d F Y') }}
                                            </span>
                                            <h4 class="text-sm font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors line-clamp-1 mb-1.5">
                                                {{ $peng->judul }}
                                            </h4>
                                            <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed mb-3">
                                                {{ strip_tags($peng->isi) }}
                                            </p>
                                        </div>
                                        <div class="pt-2 border-t border-slate-100">
                                            <a href="{{ route('pengumuman.detail', $peng->id) }}" class="text-xs font-bold text-[#FF6B35] hover:underline inline-flex items-center gap-1">
                                                <span>Baca Selengkapnya</span>
                                                <i class="fas fa-arrow-right text-[9px]"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback Mock Pengumuman 1 -->
                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row group">
                                <div class="sm:w-36 h-36 sm:h-auto relative bg-slate-800 flex-shrink-0 overflow-hidden">
                                    <img src="{{ asset('images/about-team.jpg') }}" alt="Pendaftaran Anggota" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    <span class="absolute top-2 left-2 text-[9px] font-bold text-white bg-amber-500 px-2 py-0.5 rounded-full">
                                        📌 Pinned
                                    </span>
                                </div>
                                <div class="p-4 flex flex-col justify-between flex-grow">
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-medium flex items-center gap-1 mb-1">
                                            <i class="far fa-calendar-alt"></i> 22 Oktober 2026
                                        </span>
                                        <h4 class="text-sm font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors mb-1.5">
                                            Pendaftaran Anggota Baru Dibuka
                                        </h4>
                                        <p class="text-xs text-slate-600 leading-relaxed mb-3">
                                            Seleksi terbuka bagi pelajar SMKN 1 Katapang tahun ajaran 2026/2027. Kuota terbatas 50 peserta per angkatan demi rasio optimal pelatih.
                                        </p>
                                    </div>
                                    <div class="pt-2 border-t border-slate-100">
                                        <a href="{{ route('pengumuman.publik') }}" class="text-xs font-bold text-[#FF6B35] hover:underline inline-flex items-center gap-1">
                                            <span>Baca Selengkapnya</span>
                                            <i class="fas fa-arrow-right text-[9px]"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Fallback Mock Pengumuman 2 -->
                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row group">
                                <div class="sm:w-36 h-36 sm:h-auto relative bg-slate-800 flex-shrink-0 overflow-hidden">
                                    <img src="{{ asset('images/lapangan.jpeg') }}" alt="Pemeliharaan Lapangan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-4 flex flex-col justify-between flex-grow">
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-medium flex items-center gap-1 mb-1">
                                            <i class="far fa-calendar-alt"></i> 20 Oktober 2026
                                        </span>
                                        <h4 class="text-sm font-bold text-[#0B1728] group-hover:text-[#FF6B35] transition-colors mb-1.5">
                                            Jadwal Libur Latihan & Pemeliharaan GOR
                                        </h4>
                                        <p class="text-xs text-slate-600 leading-relaxed mb-3">
                                            Sehubungan dengan pengecatan ulang garis court dan renovasi ring basket, sesi latihan tanggal 22-25 dialihkan ke training fisik mandiri.
                                        </p>
                                    </div>
                                    <div class="pt-2 border-t border-slate-100">
                                        <a href="{{ route('pengumuman.publik') }}" class="text-xs font-bold text-[#FF6B35] hover:underline inline-flex items-center gap-1">
                                            <span>Baca Selengkapnya</span>
                                            <i class="fas fa-arrow-right text-[9px]"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         5. CTA BANNER (SEBELUM FOOTER)
    =========================================== -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-gradient-to-r from-[#FF6B35] via-[#FF7542] to-[#FF5722] rounded-3xl overflow-hidden p-8 sm:p-14 text-center shadow-xl">
                <!-- Subtle Basketball Seam Lines SVG on the right side -->
                <div class="absolute right-0 top-0 bottom-0 w-80 pointer-events-none opacity-20">
                    <svg viewBox="0 0 300 300" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="200" cy="150" r="140" fill="none" stroke="white" stroke-width="8"/>
                        <line x1="60" y1="150" x2="340" y2="150" stroke="white" stroke-width="8"/>
                        <path d="M 120 40 Q 180 150 120 260" fill="none" stroke="white" stroke-width="8"/>
                        <path d="M 280 40 Q 220 150 280 260" fill="none" stroke="white" stroke-width="8"/>
                    </svg>
                </div>

                <div class="relative z-10 max-w-2xl mx-auto">
                    <!-- Top Pill Badge -->
                    <span class="inline-block px-3 py-1 bg-black/25 text-white text-[10px] font-bold tracking-wider uppercase rounded-full mb-4">
                        KOMET BASKETBALL CLUB 2026
                    </span>

                    <!-- Headline -->
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white tracking-tight mb-3">
                        Siap Menjadi Bagian dari Sejarah KOMET?
                    </h2>

                    <!-- Subtitle -->
                    <p class="text-xs sm:text-sm text-white/90 leading-relaxed mb-8 max-w-xl mx-auto">
                        Daftar sekarang dan bergabunglah dengan atlet bertalenta lainnya di SMKN 1 Katapang untuk mengasah bakat, membangun mental juara, dan meraih prestasi tertinggi.
                    </p>

                    <!-- Buttons -->
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('daftar.anggota') }}" 
                           class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#0B1728] hover:bg-[#111e33] text-white text-xs sm:text-sm font-bold rounded-lg shadow-md transition transform hover:scale-[1.02]">
                            <span>Daftar Sekarang</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ route('member.profile') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 border border-white/30 text-white text-xs sm:text-sm font-semibold rounded-lg transition">
                            <i class="fas fa-user-circle text-xs"></i>
                            <span>Portal Anggota</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SCRIPTS: GSAP PARALLAX & TIMELINE PROGRESS
    =========================================== -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Force reset scroll to top on page refresh/load so user always sees the hero parallax first
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            if (window.location.hash && window.location.hash !== '#home') {
                history.replaceState(null, null, window.location.pathname);
            }
            window.scrollTo(0, 0);

            // 1. GSAP & LENIS PARALLAX LAYERS (Exact Osmo Spec)
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                const triggerElement = document.querySelector('[data-parallax-layers]');

                if (triggerElement) {
                    const tl = gsap.timeline({
                        scrollTrigger: {
                            trigger: triggerElement,
                            start: "0% 0%",
                            end: "100% 0%",
                            scrub: 0
                        }
                    });

                    const layers = [
                        { layer: "1", yPercent: 70 },
                        { layer: "2", yPercent: 55 },
                        { layer: "3", yPercent: 40 },
                        { layer: "4", yPercent: 10 }
                    ];

                    layers.forEach((layerObj, idx) => {
                        tl.to(
                            triggerElement.querySelectorAll(`[data-parallax-layer="${layerObj.layer}"]`),
                            {
                                yPercent: layerObj.yPercent,
                                ease: "none"
                            },
                            idx === 0 ? undefined : "<"
                        );
                    });
                }

                // Smooth Lenis integration with GSAP ticker
                if (typeof Lenis !== 'undefined') {
                    const lenis = new Lenis({
                        duration: 1.2,
                        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                        smoothWheel: true,
                    });
                    lenis.on('scroll', ScrollTrigger.update);
                    gsap.ticker.add((time) => {
                        lenis.raf(time * 1000);
                    });
                    gsap.ticker.lagSmoothing(0);
                }
            } else {
                // Fallback lightweight RAF parallax if CDN is unavailable
                const l1 = document.querySelector('[data-parallax-layer="1"]');
                const l2 = document.querySelector('[data-parallax-layer="2"]');
                const l3 = document.querySelector('[data-parallax-layer="3"]');
                const l4 = document.querySelector('[data-parallax-layer="4"]');
                const heroSec = document.getElementById('home');

                window.addEventListener('scroll', function() {
                    if (!heroSec) return;
                    const scrollY = window.scrollY;
                    const heroHeight = heroSec.offsetHeight;
                    if (scrollY <= heroHeight) {
                        const p = scrollY / heroHeight;
                        if (l1) l1.style.transform = `translate3d(0, ${p * 70}%, 0)`;
                        if (l2) l2.style.transform = `translate3d(0, ${p * 55}%, 0)`;
                        if (l3) l3.style.transform = `translate3d(0, ${p * 40}%, 0)`;
                        if (l4) l4.style.transform = `translate3d(0, ${p * 10}%, 0)`;
                    }
                }, { passive: true });
            }

            // 2. TIMELINE ANIMATED FOREGROUND PROGRESS LINE
            const timelineContainer = document.getElementById('timeline-interactive-container');
            const timelineProgressLine = document.getElementById('timeline-progress-line');
            const milestoneItems = document.querySelectorAll('.timeline-milestone');

            function updateTimelineProgress() {
                if (!timelineContainer || !timelineProgressLine) return;

                const rect = timelineContainer.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                const triggerPoint = windowHeight * 0.55;
                const totalHeight = rect.height;
                const scrolledPast = triggerPoint - rect.top;

                let progress = scrolledPast / totalHeight;
                progress = Math.max(0, Math.min(1, progress));

                timelineProgressLine.style.height = `${progress * 100}%`;

                milestoneItems.forEach((milestone, idx) => {
                    const threshold = idx / (milestoneItems.length - 1 || 1);
                    const isActive = progress >= (threshold - 0.08);

                    const dot = milestone.querySelector('.timeline-dot');
                    const card = milestone.querySelector('.timeline-card');

                    if (dot) {
                        if (isActive) {
                            dot.className = 'timeline-dot absolute left-4 md:left-1/2 top-0 w-4 h-4 rounded-full border-2 -translate-x-1/2 mt-1.5 transition-all duration-500 z-20 border-[#FF6B35] bg-[#FF6B35] shadow-md shadow-orange-500/50 scale-125';
                        } else {
                            dot.className = 'timeline-dot absolute left-4 md:left-1/2 top-0 w-4 h-4 rounded-full border-2 -translate-x-1/2 mt-1.5 transition-all duration-500 z-20 border-slate-300 bg-white scale-100';
                        }
                    }

                    if (card) {
                        if (isActive) {
                            card.classList.remove('opacity-90', 'opacity-100', 'translate-y-3', 'translate-y-6');
                            card.classList.add('opacity-100', 'translate-y-0');
                        } else {
                            card.classList.remove('opacity-100', 'translate-y-0', 'translate-y-3');
                            card.classList.add('opacity-90', 'translate-y-3');
                        }
                    }
                });
            }

            window.addEventListener('scroll', updateTimelineProgress, { passive: true });
            updateTimelineProgress();
        });
    </script>
    @endpush
</x-public-layout>
