<?php

namespace App\Services;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfReportService
{
    public function generateStudentResultReport(Student $student, array $resultRows, array $meta = [])
    {
        $pdf = Pdf::loadView('pdfs.student-result-report', [
            'student' => $student,
            'rows' => $resultRows,
            'meta' => $meta,
        ]);

        return $pdf->download('student-result-report-' . $student->id . '.pdf');
    }
}