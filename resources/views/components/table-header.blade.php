@props(['label', 'sortable' => false, 'column' => null, 'direction' => null])

<th {{ $attributes->merge(['class' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50']) }}>
    @if($sortable && $column)
        <button 
            wire:click="sortBy('{{ $column }}')" 
            class="flex items-center gap-2 hover:text-gray-700 transition-colors"
        >
            <span>{{ $label }}</span>
            @if($direction)
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($direction === 'asc')
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    @endif
                </svg>
            @else
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
            @endif
        </button>
    @else
        {{ $label }}
    @endif
</th>
