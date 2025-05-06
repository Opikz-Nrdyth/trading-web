<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use App\Http\Middleware\CheckUserRole;
use App\Filament\Widgets\TotalCostumer;
use App\Filament\Widgets\TotalInvestment;
use App\Models\setting;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Support\Facades\Schema;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $brandName = 'Default Name';
        $brandLogo = null;

        if (Schema::hasTable('settings')) {
            $setting = Setting::first();

            if ($setting) {
                $brandName = $setting->company_name ?? $brandName;
                $brandLogo = $setting->company_logo ? config('services.storage_public') . $setting->company_logo : "";
            }
        }

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName($brandName)
            ->brandLogo($brandLogo)
            ->registration()
            ->login()
            ->darkMode(true)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,

            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\StatsOverviewWidget::class,
                TotalCostumer::class,
                TotalInvestment::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                CheckUserRole::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
