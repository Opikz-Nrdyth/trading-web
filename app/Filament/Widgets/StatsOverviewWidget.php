<?php

namespace App\Filament\Widgets;

use App\Models\news;
use App\Models\package;
use App\Models\testimonial;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $countUser = User::where("role", "User")->count();
        $countPackage = package::all()->count();
        $countTestimonials = testimonial::all()->count();
        $countNews = news::all()->count();

        // $monitorCPU = $this->getCpuLoad();

        return [
            Stat::make('Users', $countUser)
                ->color("success")
                ->descriptionIcon("heroicon-o-users", 'before')
                ->description("New user have that joined"),
            Stat::make('Package', $countPackage)
                ->color("warning")
                ->descriptionIcon("heroicon-o-squares-2x2", 'before')
                ->description("Your package to invest"),
            Stat::make('Testimonials', $countTestimonials)
                ->color("danger")
                ->descriptionIcon("heroicon-o-chat-bubble-left-ellipsis", 'before')
                ->description("testimonial from costumer"),
            Stat::make('News', $countNews)
                ->color("primary")
                ->descriptionIcon("heroicon-o-newspaper", 'before')
                ->description("Your news updated"),
        ];
    }


    // public function getCpuLoad()
    // {
    //     if (function_exists('sys_getloadavg')) {
    //         $load = sys_getloadavg(); // Mendapatkan load CPU dalam 1, 5, dan 15 menit terakhir
    //         return [
    //             '1_min' => $load[0],
    //             '5_min' => $load[1],
    //             '15_min' => $load[2],
    //         ];
    //     }
    //     return 'Load average tidak tersedia di sistem ini.';
    // }
}
