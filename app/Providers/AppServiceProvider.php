<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        \App\Models\Kegiatan::observe(\App\Observers\KegiatanObserver::class);
        \App\Models\PendaftaranKegiatan::observe(\App\Observers\PendaftaranKegiatanObserver::class);
        \App\Models\Absensi::observe(\App\Observers\AbsensiObserver::class);

        // Super admin bypass all permissions
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            if ($user->hasRole('super_admin')) {
                return true;
            }
            
            // Check permissions via Spatie for other users
            if (method_exists($user, 'hasPermissionTo')) {
                return $user->hasPermissionTo($ability) ? true : null;
            }
            
            return null;
        });
    }
}
