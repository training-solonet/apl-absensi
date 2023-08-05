<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Siswa;
use App\Observers\SiswaObserver;
use Carbon\Carbon;


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
        Siswa::observe(SiswaObserver::class);

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
    }
}
