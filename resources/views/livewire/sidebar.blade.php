<div>
    <!-- Mobile Toggle Button -->
    <div class="lg:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-200 p-4 flex items-center justify-between z-40">
        <h1 class="text-lg font-bold text-gray-900">SI Basket</h1>
        <button 
            wire:click="toggleSidebar"
            class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if($open)
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                @endif
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside class="
        fixed left-0 top-0 bottom-0 w-64 bg-gray-900 text-white
        lg:static lg:top-0
        transition-transform duration-300 ease-in-out
        {{ $open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0' }}
        z-50 overflow-y-auto
    ">
        <!-- Sidebar Header -->
        <div class="hidden lg:flex items-center justify-center h-16 bg-gray-800 border-b border-gray-700">
            <h1 class="text-xl font-bold">SI Basket</h1>
        </div>

        <!-- Menu Items -->
        <nav class="mt-4 lg:mt-0">
            @forelse($menuItems as $item)
                <div class="px-2">
                    @if(isset($item['submenu']) && !empty($item['submenu']))
                        <!-- Submenu Item -->
                        <details class="group">
                            <summary class="
                                flex items-center gap-3 px-4 py-3 rounded-lg cursor-pointer
                                text-gray-300 hover:text-white hover:bg-gray-800
                                group-open:bg-gray-800 group-open:text-white
                            ">
                                @switch($item['icon'])
                                    @case('check-square')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @break
                                    @default
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                @endswitch
                                <span class="flex-1 font-medium">{{ $item['label'] }}</span>
                                <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"></path>
                                </svg>
                            </summary>
                            <div class="pl-4 space-y-1 mt-2">
                                @foreach($item['submenu'] as $subitem)
                                    <a 
                                        href="{{ route($subitem['route']) }}" 
                                        wire:navigate
                                        class="
                                            block px-4 py-2 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-gray-800
                                            {{ request()->routeIs($subitem['route']) ? 'bg-gray-800 text-white font-medium' : '' }}
                                        "
                                    >
                                        {{ $subitem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </details>
                    @else
                        <!-- Regular Menu Item -->
                        <a 
                            href="{{ route($item['route']) }}" 
                            wire:navigate
                            class="
                                flex items-center gap-3 px-4 py-3 rounded-lg
                                text-gray-300 hover:text-white hover:bg-gray-800
                                transition-colors
                                {{ request()->routeIs($item['route']) ? 'bg-gray-800 text-white font-medium' : '' }}
                            "
                        >
                            <!-- Icons -->
                            @switch($item['icon'])
                                @case('home')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9M9 5h6"></path>
                                    </svg>
                                @break
                                @case('users')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @break
                                @case('calendar')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @break
                                @case('clipboard')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                @break
                                @case('credit-card')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                @break
                                @case('bell')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                @break
                                @case('lock')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                @break
                                @case('history')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @break
                                @case('file-text')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                @break
                                @default
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                            @endswitch
                            <span class="font-medium">{{ $item['label'] }}</span>
                        </a>
                    @endif
                </div>
            @empty
                <div class="px-4 py-3 text-gray-400 text-sm">
                    Tidak ada menu yang tersedia
                </div>
            @endforelse
        </nav>
    </aside>

    <!-- Overlay (mobile) -->
    @if($open)
        <div 
            class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40"
            wire:click="toggleSidebar"
        ></div>
    @endif
</div>
