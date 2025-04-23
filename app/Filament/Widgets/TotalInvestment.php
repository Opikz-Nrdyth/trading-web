<?php

namespace App\Filament\Widgets;

use App\Models\investment as ModelsInvestment;
use Filament\Widgets\ChartWidget;

class TotalInvestment extends ChartWidget
{
    protected static ?string $heading = 'Total Investment';

    protected function getData(): array
    {
        $invest = ModelsInvestment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count')
            ->toArray();

        $data = array_map(function ($month) use ($invest) {
            return $invest[$month - 1] ?? 0;
        }, range(1, 12));


        return [
            'datasets' => [
                [
                    'label' => 'Total Investment',
                    'data' => $data,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
