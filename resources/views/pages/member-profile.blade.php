@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-500">Profil</p>
            <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
        </div>
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 lg:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-br from-orange-500 to-orange-600 text-2xl font-bold text-white">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name ?? 'User' }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                <span class="mt-3 inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                    {{ ucfirst(Auth::user()->role ?? 'Member') }}
                </span>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Informasi Akun</h3>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Nama</p>
                    <p class="mt-2 font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name ?? '-' }}</p>
                </div>
                <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Email</p>
                    <p class="mt-2 font-semibold text-gray-900 dark:text-white">{{ Auth::user()->email ?? '-' }}</p>
                </div>
                <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Status</p>
                    <p class="mt-2 font-semibold text-gray-900 dark:text-white">{{ ucfirst(Auth::user()->role ?? 'Member') }}</p>
                </div>
                <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-700/50">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Terakhir Login</p>
                    <p class="mt-2 font-semibold text-gray-900 dark:text-white">{{ now()->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="mt-6 rounded-xl border border-dashed border-orange-200 bg-orange-50 p-4 dark:border-orange-900/50 dark:bg-orange-900/10">
                <p class="text-sm text-orange-700 dark:text-orange-300">
                    Halaman profil ini masih bersifat dasar agar user tidak mengalami error saat membuka menu profil.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
