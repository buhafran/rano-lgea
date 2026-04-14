<?php

namespace App\Services;

use App\Jobs\ProcessAnnualCensusImportJob;
use App\Models\AnnualCensusImport;

class ImportApprovalService
{
    public function approveAndQueue(AnnualCensusImport $import, array $rows = []): void
    {
        $import->update([
            'notes' => trim(($import->notes ? $import->notes . PHP_EOL : '') . 'Approved for processing by user ' . auth()->id()),
        ]);

        ProcessAnnualCensusImportJob::dispatch($import->id, $rows);
    }

    public function reject(AnnualCensusImport $import, ?string $reason = null): void
    {
        $import->update([
            'notes' => trim(($import->notes ? $import->notes . PHP_EOL : '') . 'Rejected: ' . ($reason ?: 'No reason supplied')),
        ]);
    }
}