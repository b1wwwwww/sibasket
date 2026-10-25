@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-500">Pengaturan</p>
        <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Pengaturan Akun</h1>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center justify-between border-b border-gray-200 pb-4 dark:border-gray-700">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Preferensi</h2>
                <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700 dark:bg-green-900/30 dark:text-green-300">Aktif</span>
            </div>

            <div class="mt-6 space-y-4 text-sm text-gray-700 dark:text-gray-300">
                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <span>Notifikasi kegiatan</span>
                    <span class="font-semibold text-gray-900 dark:text-white">Aktif</span>
                </div>
                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <span>Mode gelap</span>
                    <span class="font-semibold text-gray-900 dark:text-white">Tersedia</span>
                </div>
                <div class="flex items-center justify-between rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <span>Bahasa</span>
                    <span class="font-semibold text-gray-900 dark:text-white">Indonesia</span>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>
    </div>
</div>
@endsection
