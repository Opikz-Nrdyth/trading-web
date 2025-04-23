<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
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
        $this->loadCurrencyData();
    }

    private function loadCurrencyData()
    {
        // Simpan data currency ke cache jika belum ada atau sudah kedaluwarsa
        Cache::remember('data_currency', 3600, function () {
            $response = Http::get('https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/idr.json');
            if ($response->successful()) {
                return json_decode($response->body(), true);
            }
            return [];
        });
    }
}
