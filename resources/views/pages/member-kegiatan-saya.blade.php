@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-500">Aktivitas</p>
        <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Kegiatan Saya</h1>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between border-b border-gray-200 pb-4 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Daftar Kegiatan</h2>
            <span class="rounded-full bg-orange-100 px-2.5 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">Belum ada data</span>
        </div>

        <div class="mt-6 rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6 text-center dark:border-gray-600 dark:bg-gray-700/40">
            <p class="text-gray-600 dark:text-gray-300">Belum ada kegiatan yang ditambahkan untuk akun ini.</p>
        </div>
    </div>
</div>
@endsection
