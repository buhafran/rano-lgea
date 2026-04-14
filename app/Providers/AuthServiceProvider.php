<?php

namespace App\Providers;

use App\Models\AnnualCensusImport;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Policies\AnnualCensusImportPolicy;
use App\Policies\SchoolPolicy;
use App\Policies\StudentPolicy;
use App\Policies\TeacherPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        School::class => SchoolPolicy::class,
        Student::class => StudentPolicy::class,
        Teacher::class => TeacherPolicy::class,
        AnnualCensusImport::class => AnnualCensusImportPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}