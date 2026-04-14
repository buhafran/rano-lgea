<?php

namespace App\Filament\Widgets;

use App\Models\IndicatorValue;
use App\Models\AcademicSession;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IndicatorSnapshotStats extends BaseWidget
{
    protected function getStats(): array
    {
        $session = AcademicSession::where('is_current', true)->first();

        if (! $session) {
            return [
                Stat::make('GER', '-'),
                Stat::make('NER', '-'),
                Stat::make('PPE', '-'),
                Stat::make('PTR Records', '0'),
            ];
        }

        $ger = IndicatorValue::whereHas('indicatorDefinition', fn ($q) => $q->where('code', 'GER'))
            ->where('academic_session_id', $session->id)
            ->value('total_value');

        $ner = IndicatorValue::whereHas('indicatorDefinition', fn ($q) => $q->where('code', 'NER'))
            ->where('academic_session_id', $session->id)
            ->value('total_value');

        $ppe = IndicatorValue::whereHas('indicatorDefinition', fn ($q) => $q->where('code', 'PPE'))
            ->where('academic_session_id', $session->id)
            ->value('total_value');

        $ptrCount = IndicatorValue::whereHas('indicatorDefinition', fn ($q) => $q->where('code', 'PTR'))
            ->where('academic_session_id', $session->id)
            ->count();

        return [
            Stat::make('GER', $ger ? $ger . '%' : '-'),
            Stat::make('NER', $ner ? $ner . '%' : '-'),
            Stat::make('PPE', $ppe ? $ppe . '%' : '-'),
            Stat::make('PTR Records', (string) $ptrCount),
        ];
    }
}