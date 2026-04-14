<?php

namespace App\Filament\Resources\AcademicSessions\Pages;

use App\Filament\Resources\AcademicSessions\AcademicSessionResource;
use Filament\Resources\Pages\Page;

class SchoolComparisonPage extends Page
{
    protected static string $resource = AcademicSessionResource::class;

    protected string $view = 'filament.resources.academic-sessions.pages.school-comparison-page';
}
