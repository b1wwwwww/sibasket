@extends('emails.layouts.base')

@section('content')
<div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; color: #333; line-height: 1.6;">
    
    <h2 style="color: #FF6B35; margin-bottom: 20px;">🏀 Jangan Lupa! Latihan {{ ucfirst($kegiatan->jadwalLatihan->hari) }}</h2>
    
    <p>Halo <strong>{{ $nama }}</strong>,</p>
    
    <p>Latihan rutin Anda akan dilaksanakan:</p>
    
    <div style="background-color: #f8f9fa; border-left: 4px solid #FF6B35; padding: 15px; margin: 20px 0; border-radius: 4px;">
        <p style="margin: 8px 0;"><strong>📅 Hari:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}</p>
        <p style="margin: 8px 0;"><strong>🕐 Jam:</strong> {{ \Carbon\Carbon::parse($kegiatan->jadwalLatihan->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->jadwalLatihan->jam_selesai)->format('H:i') }} WIB</p>
        <p style="margin: 8px 0;"><strong>📍 Lokasi:</strong> {{ $kegiatan->lokasi }}</p>
        <p style="margin: 8px 0;"><strong>🏷️ Kategori:</strong> {{ ucfirst($kegiatan->kategori) }}</p>
    </div>
    
    <p style="color: #d32f2f; font-weight: bold; margin: 20px 0;">⚠️ PENTING: Segera deklarasikan status kehadiran Anda!</p>
    
    <p>Pilih salah satu:</p>
    <ul style="margin-left: 20px;">
        <li><strong>✅ Hadir</strong> - Anda akan menghadiri latihan</li>
        <li><strong>🤒 Sakit</strong> - Tidak bisa hadir karena sakit (sertakan alasan)</li>
        <li><strong>📋 Izin</strong> - Tidak bisa hadir dengan alasan lain (sertakan alasan)</li>
    </ul>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $webUrl }}/dashboard/kegiatan-saya" style="background-color: #FF6B35; color: white; padding: 12px 30px; border-radius: 4px; text-decoration: none; font-weight: bold; display: inline-block;">
            BUKA KEGIATAN SAYA
        </a>
    </div>
    
    <p style="color: #666; font-size: 14px; margin-top: 30px;">
        Jika Anda mengalami kesulitan mengakses link di atas, silakan kunjungi:<br>
        <code style="background-color: #f0f0f0; padding: 2px 6px; border-radius: 3px;">{{ $webUrl }}/dashboard/kegiatan-saya</code>
    </p>
    
    <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">
    
    <p style="color: #999; font-size: 12px; margin: 0;">
        Ini adalah notifikasi otomatis dari sistem SIBASKET. Silakan jangan balas email ini.<br>
        Terima kasih atas komitmen Anda terhadap kegiatan latihan basket kami! 💪
    </p>

</div>
@endsection
