<?php

namespace App\Filament\Widgets;

use App\Models\School;
use App\Models\SchoolYearProfile;
use App\Models\Teacher;
use App\Models\MaintenanceRecord;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LgeaOverviewStats extends BaseWidget
{
    protected function getStats(): array
    {
        $schools = School::count();
        $teachers = Teacher::count();
        $profiles = SchoolYearProfile::all();

        $primaryEnrollment = $profiles->sum(fn ($row) => $row->primary_total);
        $prePrimaryEnrollment = $profiles->sum(fn ($row) => $row->pre_primary_total);
        $openMaintenance = MaintenanceRecord::whereIn('status', ['pending', 'in_progress'])->count();

        return [
            Stat::make('Schools', number_format($schools)),
            Stat::make('Teachers', number_format($teachers)),
            Stat::make('Primary Enrolment', number_format($primaryEnrollment)),
            Stat::make('Pre-Primary Enrolment', number_format($prePrimaryEnrollment)),
            Stat::make('Open Maintenance', number_format($openMaintenance)),
        ];
    }
}