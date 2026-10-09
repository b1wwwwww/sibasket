<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Keuangan</h1>
            <p class="mt-1 text-sm text-gray-600">Ringkasan pemasukan dan pengeluaran kas klub</p>
        </div>
        <a href="/dashboard/keuangan" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Transaksi
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white px-4 py-5 sm:px-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Tanggal Dari -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                <input 
                    type="date" 
                    wire:model.live="tanggal_dari"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
            </div>

            <!-- Tanggal Sampai -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input 
                    type="date" 
                    wire:model.live="tanggal_sampai"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                />
            </div>

            <!-- Kategori Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select 
                    wire:model.live="kategori"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}">{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Total Pemasukan -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Total Pemasukan</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">
                        Rp {{ number_format($summary['totalPemasukan'], 2, ',', '.') }}
                    </p>
                </div>
                <svg class="w-12 h-12 text-green-200" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Total Pengeluaran</p>
                    <p class="text-2xl font-bold text-red-600 mt-2">
                        Rp {{ number_format($summary['totalPengeluaran'], 2, ',', '.') }}
                    </p>
                </div>
                <svg class="w-12 h-12 text-red-200" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L11.414 12l3.293 3.293a1 1 0 01-1.414 1.414L10 13.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 12 5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <!-- Saldo -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 {{ $summary['saldo'] >= 0 ? 'border-blue-500' : 'border-yellow-500' }}">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Saldo Kas</p>
                    <p class="text-2xl font-bold {{ $summary['saldo'] >= 0 ? 'text-blue-600' : 'text-yellow-600' }} mt-2">
                        Rp {{ number_format($summary['saldo'], 2, ',', '.') }}
                    </p>
                </div>
                <svg class="w-12 h-12 {{ $summary['saldo'] >= 0 ? 'text-blue-200' : 'text-yellow-200' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.16 2.75a.75.75 0 00-1.32 0l-3.5 9.5A.75.75 0 003.5 13h13a.75.75 0 00.66-1.25l-3.5-9.5z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
                    <p class="text-2xl font-bold text-purple-600 mt-2">
                        {{ $summary['countTransaksi'] }}
                    </p>
                </div>
                <svg class="w-12 h-12 text-purple-200" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h6v4H4a1 1 0 01-1-1v-2zm0 2v2a1 1 0 001 1h6v-4H4a1 1 0 00-1 1zm8 0a1 1 0 011-1h4v4h-4a1 1 0 01-1-1v-2zm1 2v2a1 1 0 001 1h4v-4h-4a1 1 0 00-1 1z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Breakdown per Kategori -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Breakdown per Kategori</h3>
        </div>
        
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Kategori</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Pemasukan</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Pengeluaran</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Saldo</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($breakdown as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item['kategori'] }}</td>
                        <td class="px-6 py-4 text-sm text-right text-green-600 font-semibold">
                            Rp {{ number_format($item['pemasukan'], 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-right text-red-600 font-semibold">
                            Rp {{ number_format($item['pengeluaran'], 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-right font-semibold {{ ($item['pemasukan'] - $item['pengeluaran']) >= 0 ? 'text-blue-600' : 'text-yellow-600' }}">
                            Rp {{ number_format(($item['pemasukan'] - $item['pengeluaran']), 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                            Tidak ada data untuk periode ini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Detail Transaksi -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Detail Transaksi</h3>
        </div>
        
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Anggota</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Kategori</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Jenis</th>
                    <th class="px-6 py-3 text-right text-sm font-medium text-gray-700">Nominal</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($transaksi as $t)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $t->tanggal_bayar->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $t->anggota->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $t->kategori }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($t->jenis === 'pemasukan')
                                <x-badge type="success" label="Pemasukan" />
                            @else
                                <x-badge type="danger" label="Pengeluaran" />
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-right text-gray-900">
                            Rp {{ number_format($t->nominal, 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($t->status === 'lunas')
                                <x-badge type="success" label="Lunas" />
                            @elseif($t->status === 'pending')
                                <x-badge type="warning" label="Pending" />
                            @else
                                <x-badge type="danger" label="Nunggak" />
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                            Tidak ada transaksi untuk periode ini
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
