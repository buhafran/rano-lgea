<?php

namespace App\Services;

use App\Models\StudentScore;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class BroadsheetService
{
    public function build(
        int $schoolId,
        int $academicSessionId,
        int $termId,
        ?int $classLevelId = null
    ): Collection {
        return StudentScore::query()
            ->with(['student', 'subject', 'classLevel'])
            ->where('school_id', $schoolId)
            ->where('academic_session_id', $academicSessionId)
            ->where('term_id', $termId)
            ->when($classLevelId, fn ($q) => $q->where('class_level_id', $classLevelId))
            ->get()
            ->groupBy(fn ($row) => $row->student?->full_name ?? 'Unknown');
    }

    public function downloadPdf(
        int $schoolId,
        int $academicSessionId,
        int $termId,
        ?int $classLevelId = null
    ) {
        $rows = $this->build($schoolId, $academicSessionId, $termId, $classLevelId);

        $pdf = Pdf::loadView('pdfs.broadsheet', [
            'rows' => $rows,
        ]);

        return $pdf->download('broadsheet.pdf');
    }
}