<?php

namespace App\Filament\Widgets;

use App\Models\MaintenanceRecord;
use Filament\Widgets\ChartWidget;

class MaintenanceStatusChart extends ChartWidget
{
    protected ?string $heading = 'Maintenance Status Summary';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Maintenance',
                    'data' => [
                        MaintenanceRecord::where('status', 'pending')->count(),
                        MaintenanceRecord::where('status', 'in_progress')->count(),
                        MaintenanceRecord::where('status', 'completed')->count(),
                    ],
                ],
            ],
            'labels' => ['Pending', 'In Progress', 'Completed'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}