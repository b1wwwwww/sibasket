@extends('layouts.app')

@section('title', 'Manajemen Keuangan')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Manajemen Keuangan</h2>
            <livewire:keuangan-table />
        </div>
    </div>
@endsection
