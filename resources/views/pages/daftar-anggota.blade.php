<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota - SIBASKET</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-blue-50 to-orange-50 min-h-screen py-8">
    <div class="container mx-auto">
        @livewire('public-pendaftaran-form')
    </div>
    @livewireScripts
</body>
</html>
