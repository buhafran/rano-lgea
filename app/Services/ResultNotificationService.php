<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ResultNotificationService
{
    public function sendEmailNotification(Student $student): void
    {
        if (! filled($student->guardian_email ?? null)) {
            return;
        }

        Mail::raw(
            'A result is now available for ' . $student->full_name . '.',
            function ($message) use ($student): void {
                $message->to($student->guardian_email)
                    ->subject('Student Result Available');
            }
        );
    }

    public function sendSmsNotification(Student $student, string $message): void
    {
        Log::info('SMS result notification', [
            'student_id' => $student->id,
            'guardian_phone' => $student->guardian_phone,
            'message' => $message,
        ]);
    }
}