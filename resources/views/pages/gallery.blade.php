<x-public-layout :title="'Galeri KOMET - SIBASKET'">

    <!-- HERO HEADER -->
    <section class="relative bg-[#0B1728] text-white pt-28 pb-16 overflow-hidden">
        <!-- Background subtle pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-6 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full border border-orange-400/30 bg-orange-500/10 text-xs font-mono tracking-[0.25em] text-orange-300 uppercase mb-5">
                📸 Dokumentasi
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                Galeri <span class="text-[#FF6B35]">KOMET</span>
            </h1>
            <p class="mt-4 text-sm sm:text-base text-slate-400 max-w-xl mx-auto leading-relaxed">
                Kumpulan momen terbaik dari setiap latihan, turnamen, dan kebersamaan keluarga besar KOMET Basketball SMKN 1 Katapang.
            </p>
        </div>
    </section>

    <!-- GALLERY GRID -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            @php
                $images = [
                    ['src' => 'galery/tim-putra.jpeg', 'alt' => 'Tim Putra KOMET'],
                    ['src' => 'galery/tim-putri.jpeg', 'alt' => 'Tim Putri KOMET'],
                    ['src' => 'galery/budi-bakti-champions.jpeg', 'alt' => 'Budi Bakti Champions'],
                    ['src' => 'galery/juara-bsbl.webp', 'alt' => 'Juara BSBL'],
                    ['src' => 'galery/juara2-o2sn.webp', 'alt' => 'Juara 2 O2SN'],
                    ['src' => 'galery/bubaci-league.jpeg', 'alt' => 'Bubaci League'],
                    ['src' => 'galery/bubaci-1.jpeg', 'alt' => 'Bubaci 1'],
                    ['src' => 'galery/bubaci-2.jpeg', 'alt' => 'Bubaci 2'],
                    ['src' => 'galery/fotbar.jpeg', 'alt' => 'Foto Bersama'],
                    ['src' => 'galery/fotbar-2.jpeg', 'alt' => 'Foto Bersama 2'],
                    ['src' => 'galery/fotbar-3.jpeg', 'alt' => 'Foto Bersama 3'],
                    ['src' => 'galery/fotbar-4.jpeg', 'alt' => 'Foto Bersama 4'],
                    ['src' => 'galery/fotbar-5.jpeg', 'alt' => 'Foto Bersama 5'],
                    ['src' => 'galery/foto-cowo.jpeg', 'alt' => 'Foto Tim'],
                    ['src' => 'galery/tim-putra1.jpeg', 'alt' => 'Tim Putra 1'],
                    ['src' => 'galery/tim-putra2.jpeg', 'alt' => 'Tim Putra 2'],
                    ['src' => 'galery/tim-putrra3.jpeg', 'alt' => 'Tim Putra 3'],
                    ['src' => 'galery/tim-putri1.jpeg', 'alt' => 'Tim Putri 1'],
                    ['src' => 'galery/tim-putri2.jpeg', 'alt' => 'Tim Putri 2'],
                    ['src' => 'galery/latding-alumni.jpeg', 'alt' => 'Latihan Dengan Alumni'],
                    ['src' => 'galery/latding-alumni1.jpeg', 'alt' => 'Latihan Dengan Alumni 1'],
                    ['src' => 'galery/o2sn-2024-1.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-2.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-3.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-4.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-5.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-6.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-7.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-8.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-9.webp', 'alt' => 'O2SN 2024'],
                    ['src' => 'galery/o2sn-2024-10.webp', 'alt' => 'O2SN 2024'],
                ];
            @endphp

            <!-- 3 Column Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($images as $index => $image)
                    <div class="gallery-item group relative rounded-xl overflow-hidden shadow-md border border-slate-200/60 bg-slate-100 aspect-[4/3] cursor-pointer"
                         onclick="openLightbox({{ $index }})">
                        <img src="{{ asset('images/' . $image['src']) }}" 
                             alt="{{ $image['alt'] }}" 
                             loading="lazy"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                            <span class="text-white text-sm font-medium">{{ $image['alt'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- LIGHTBOX MODAL -->
    <div id="lightbox" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-sm hidden items-center justify-center" onclick="closeLightbox(event)">
        <!-- Close Button -->
        <button onclick="closeLightbox(event)" class="absolute top-6 right-6 text-white/70 hover:text-white text-3xl z-50 transition-colors">
            <i class="fas fa-times"></i>
        </button>

        <!-- Previous Button -->
        <button onclick="prevImage(event)" class="absolute left-4 top-1/2 -translate-y-1/2 text-white/60 hover:text-white text-4xl z-50 transition-colors p-2">
            <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Image Container -->
        <div class="max-w-5xl max-h-[85vh] px-12">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
        </div>

        <!-- Next Button -->
        <button onclick="nextImage(event)" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/60 hover:text-white text-4xl z-50 transition-colors p-2">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Caption -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/80 text-sm font-medium bg-black/40 px-4 py-2 rounded-full">
            <span id="lightbox-caption"></span>
            <span class="text-white/40 ml-2" id="lightbox-counter"></span>
        </div>
    </div>

@push('scripts')
<script>
    const galleryImages = @json($images);
    let currentIndex = 0;

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        const lb = document.getElementById('lightbox');
        lb.classList.remove('hidden');
        lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(e) {
        if (e) e.stopPropagation();
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function nextImage(e) {
        if (e) e.stopPropagation();
        currentIndex = (currentIndex + 1) % galleryImages.length;
        updateLightbox();
    }

    function prevImage(e) {
        if (e) e.stopPropagation();
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        updateLightbox();
    }

    function updateLightbox() {
        const img = document.getElementById('lightbox-img');
        const caption = document.getElementById('lightbox-caption');
        const counter = document.getElementById('lightbox-counter');
        img.src = '/images/' + galleryImages[currentIndex].src;
        img.alt = galleryImages[currentIndex].alt;
        caption.textContent = galleryImages[currentIndex].alt;
        counter.textContent = (currentIndex + 1) + ' / ' + galleryImages.length;
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const lb = document.getElementById('lightbox');
        if (lb.classList.contains('hidden')) return;
        if (e.key === 'Escape') closeLightbox(e);
        if (e.key === 'ArrowRight') nextImage(e);
        if (e.key === 'ArrowLeft') prevImage(e);
    });
</script>
@endpush

@push('styles')
<style>
    .gallery-item {
        animation: fadeInUp 0.6s ease-out both;
    }
    @for ($i = 0; $i < count($images); $i++)
    .gallery-item:nth-child({{ $i + 1 }}) {
        animation-delay: {{ min($i * 0.05, 0.5) }}s;
    }
    @endfor
</style>
@endpush

</x-public-layout>

