<div>
    <!-- Mobile Toggle Button -->
    <div class="lg:hidden fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 flex items-center justify-between z-40 transition-colors duration-300">
        <h1 class="text-lg font-bold text-gray-900 dark:text-white">SI Basket</h1>
        <button 
            wire:click="toggleSidebar"
            class="p-2 rounded-md text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700"
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
        fixed left-0 top-0 bottom-0 w-64 bg-white dark:bg-gray-900 text-gray-900 dark:text-white
        lg:sticky lg:top-0 lg:h-screen
        transition-colors duration-300 ease-in-out
        {{ $open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0' }}
        z-50 border-r border-gray-200 dark:border-gray-800
        flex flex-col overflow-hidden
    ">
        <!-- Sidebar Header -->
        <div class="hidden lg:flex items-center gap-3 px-6 h-16 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shrink-0 transition-colors duration-300">
            <div class="w-8 h-8 rounded-lg bg-orange-600 flex items-center justify-center text-white font-bold text-sm">
                🏀
            </div>
            <div>
                <h1 class="text-base font-bold text-gray-900 dark:text-white">SIBASKET</h1>
                <span class="text-xs text-orange-600 dark:text-orange-400 font-medium">Pro Plan</span>
            </div>
        </div>

        <!-- Menu Items -->
        <nav class="mt-4 lg:mt-6 px-3 flex-1 min-h-0 overflow-y-auto space-y-1 pb-2">
            @forelse($menuItems as $item)
                <div>
                    @if(isset($item['submenu']) && !empty($item['submenu']))
                        <!-- Submenu Item -->
                        <details class="group">
                            <summary class="
                                flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer
                                text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800
                                group-open:bg-gray-100 dark:group-open:bg-gray-800 group-open:text-gray-900 dark:group-open:text-white
                                transition-colors
                            ">
                                @switch($item['icon'])
                                    @case('check-square')
                                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @break
                                    @default
                                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                @endswitch
                                <span class="flex-1 font-medium text-sm">{{ $item['label'] }}</span>
                                <svg class="w-4 h-4 transition-transform group-open:rotate-180 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"></path>
                                </svg>
                            </summary>
                            <div class="pl-4 space-y-1 mt-1">
                                @foreach($item['submenu'] as $subitem)
                                    <a 
                                        href="{{ route($subitem['route']) }}" 
                                        wire:navigate
                                        class="
                                            block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800
                                            {{ request()->routeIs($subitem['route']) ? 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white font-medium border-l-2 border-orange-600' : '' }}
                                            transition-colors
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
                                flex items-center gap-3 px-3 py-2.5 rounded-lg
                                text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800
                                transition-colors
                                {{ request()->routeIs($item['route']) ? 'bg-orange-600 text-white font-medium shadow-sm' : '' }}
                            "
                        >
                            <!-- Icons -->
                            @switch($item['icon'])
                                @case('home')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9M9 5h6"></path>
                                    </svg>
                                @break
                                @case('users')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @break
                                @case('calendar')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @break
                                @case('clipboard')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                @break
                                @case('credit-card')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                @break
                                @case('bell')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                @break
                                @case('lock')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                @break
                                @case('history')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @break
                                @case('file-text')
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                @break
                                @default
                                    <svg class="w-5 h-5 {{ request()->routeIs($item['route']) ? 'text-white' : 'text-gray-600 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                            @endswitch
                            <span class="font-medium text-sm">{{ $item['label'] }}</span>
                        </a>
                    @endif
                </div>
            @empty
                <div class="px-3 py-2 text-gray-500 dark:text-gray-400 text-sm">
                    Tidak ada menu
                </div>
            @endforelse
        </nav>
        
        <!-- Sidebar Footer (Fixed at bottom) -->
        <div class="mt-auto p-3 space-y-2 border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shrink-0 transition-colors duration-300 w-full sticky bottom-0 z-10">
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors text-sm font-medium w-full">
                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Settings
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-sm font-medium w-full">
                <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </aside>

    <!-- Overlay (mobile) -->
    @if($open)
        <div 
            class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40"
            wire:click="toggleSidebar"
        ></div>
    @endif
</div>
