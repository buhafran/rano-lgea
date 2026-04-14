<?php

namespace App\Services;

use App\Models\ResultPublication;
use App\Models\ResultAccessToken;
use App\Models\Student;
use Illuminate\Support\Str;

class ResultPublishingService
{
    public function publish(
        int $schoolId,
        int $academicSessionId,
        int $termId,
        ?int $classLevelId = null,
        ?string $notes = null
    ): ResultPublication {
        return ResultPublication::updateOrCreate(
            [
                'school_id' => $schoolId,
                'academic_session_id' => $academicSessionId,
                'term_id' => $termId,
                'class_level_id' => $classLevelId,
            ],
            [
                'status' => 'published',
                'published_by' => auth()->id(),
                'published_at' => now(),
                'notes' => $notes,
            ]
        );
    }

    public function archive(ResultPublication $publication): ResultPublication
    {
        $publication->update([
            'status' => 'archived',
        ]);

        return $publication;
    }

    public function generateAccessToken(Student $student, int $academicSessionId, int $termId, ?\DateTimeInterface $expiresAt = null): ResultAccessToken
    {
        return ResultAccessToken::updateOrCreate(
            [
                'student_id' => $student->id,
                'academic_session_id' => $academicSessionId,
                'term_id' => $termId,
            ],
            [
                'access_code' => strtoupper(Str::random(10)),
                'is_used' => false,
                'used_at' => null,
                'expires_at' => $expiresAt,
                'generated_by' => auth()->id(),
            ]
        );
    }

    public function validateAccess(string $admissionNo, string $accessCode, int $academicSessionId, int $termId): ?Student
    {
        $student = Student::where('admission_no', $admissionNo)->first();

        if (! $student) {
            return null;
        }

        $token = ResultAccessToken::where('student_id', $student->id)
            ->where('academic_session_id', $academicSessionId)
            ->where('term_id', $termId)
            ->where('access_code', $accessCode)
            ->first();

        if (! $token || $token->isExpired()) {
            return null;
        }

        $token->update([
            'is_used' => true,
            'used_at' => now(),
        ]);

        return $student;
    }
}