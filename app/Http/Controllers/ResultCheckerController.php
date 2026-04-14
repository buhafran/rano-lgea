<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Term;
use App\Models\StudentScore;
use App\Services\ResultPublishingService;
use Illuminate\Http\Request;

class ResultCheckerController extends Controller
{
    public function form()
    {
        return view('result-checker.form', [
            'sessions' => AcademicSession::orderByDesc('id')->get(),
            'terms' => Term::orderBy('sort_order')->get(),
        ]);
    }

    public function check(Request $request, ResultPublishingService $publishingService)
    {
        $validated = $request->validate([
            'admission_no' => ['required', 'string'],
            'access_code' => ['required', 'string'],
            'academic_session_id' => ['required', 'integer'],
            'term_id' => ['required', 'integer'],
        ]);

        $student = $publishingService->validateAccess(
            admissionNo: $validated['admission_no'],
            accessCode: $validated['access_code'],
            academicSessionId: (int) $validated['academic_session_id'],
            termId: (int) $validated['term_id'],
        );

        if (! $student) {
            return back()->withErrors([
                'access_code' => 'Invalid admission number or access code.',
            ])->withInput();
        }

        $scores = StudentScore::with(['subject', 'school', 'academicSession', 'term'])
            ->where('student_id', $student->id)
            ->where('academic_session_id', $validated['academic_session_id'])
            ->where('term_id', $validated['term_id'])
            ->get();

        return view('result-checker.result', [
            'student' => $student,
            'scores' => $scores,
        ]);
    }
}
