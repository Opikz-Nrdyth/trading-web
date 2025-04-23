<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class TotalCostumer extends ChartWidget
{
    protected static ?string $heading = 'Total Costumer';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count')
            ->toArray();

        $data = array_map(function ($month) use ($users) {
            return $users[$month - 1] ?? 0;
        }, range(1, 12));

        return [
            'datasets' => [
                [
                    'label' => 'Total Costumer',
                    'data' => $data,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
