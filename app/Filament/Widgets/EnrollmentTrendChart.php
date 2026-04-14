<?php

namespace App\Filament\Widgets;

use App\Models\SchoolYearProfile;
use Filament\Widgets\ChartWidget;

class EnrollmentTrendChart extends ChartWidget
{
    protected ?string $heading = 'Enrollment Summary';

    protected function getData(): array
    {
        $profiles = SchoolYearProfile::with('academicSession')->get()
            ->groupBy(fn ($row) => $row->academicSession?->name ?? 'Unknown')
            ->sortKeys();

        return [
            'datasets' => [
                [
                    'label' => 'Primary Enrollment',
                    'data' => $profiles->map(fn ($rows) => $rows->sum(fn ($row) => $row->primary_total))->values()->all(),
                ],
                [
                    'label' => 'Pre-Primary Enrollment',
                    'data' => $profiles->map(fn ($rows) => $rows->sum(fn ($row) => $row->pre_primary_total))->values()->all(),
                ],
            ],
            'labels' => $profiles->keys()->values()->all(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}