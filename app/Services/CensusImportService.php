<?php

namespace App\Services;

use App\Models\AnnualCensusImport;
use App\Models\IndicatorValue;
use App\Models\PrivateEnrollmentStatistic;
use Illuminate\Http\UploadedFile;

class CensusImportService
{
    public function storeImportFile(UploadedFile $file, int $academicSessionId, string $title, ?string $type = null): AnnualCensusImport
    {
        $path = $file->store('annual-census-imports', 'public');

        return AnnualCensusImport::create([
            'academic_session_id' => $academicSessionId,
            'title' => $title,
            'file_path' => $path,
            'import_type' => $type,
            'imported_by' => auth()->id(),
            'imported_at' => now(),
        ]);
    }

    public function importPrivateEnrollmentRows(int $academicSessionId, array $rows, string $lgaName = 'RANO', ?string $sourceDocument = null): void
    {
        foreach ($rows as $row) {
            $male = (int) ($row['male'] ?? 0);
            $female = (int) ($row['female'] ?? 0);
            $total = (int) ($row['total'] ?? ($male + $female));

            PrivateEnrollmentStatistic::updateOrCreate(
                [
                    'academic_session_id' => $academicSessionId,
                    'lga_name' => $lgaName,
                    'level' => $row['level'],
                ],
                [
                    'male' => $male,
                    'female' => $female,
                    'total' => $total,
                    'source_document' => $sourceDocument,
                ]
            );
        }
    }

    public function importIndicatorRows(int $academicSessionId, array $rows, ?int $termId = null, string $lgaName = 'RANO'): void
    {
        foreach ($rows as $row) {
            $definition = \App\Models\IndicatorDefinition::where('code', strtoupper($row['code']))->first();

            if (! $definition) {
                continue;
            }

            IndicatorValue::updateOrCreate(
                [
                    'indicator_definition_id' => $definition->id,
                    'academic_session_id' => $academicSessionId,
                    'term_id' => $termId,
                    'school_id' => $row['school_id'] ?? null,
                    'ward_id' => $row['ward_id'] ?? null,
                    'lga_name' => $lgaName,
                ],
                [
                    'male_value' => $row['male_value'] ?? null,
                    'female_value' => $row['female_value'] ?? null,
                    'total_value' => $row['total_value'] ?? null,
                    'source' => 'imported',
                    'notes' => $row['notes'] ?? null,
                ]
            );
        }
    }
}