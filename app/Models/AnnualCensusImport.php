<?php

namespace App\Models;

use App\Models\Concerns\TracksUserStamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnnualCensusImport extends Model
{
    use HasFactory, TracksUserStamps;

    protected $fillable = [
        'academic_session_id',
        'title',
        'file_path',
        'import_type',
        'imported_by',
        'imported_at',
        'notes',
        'createdby',
        'updatedby',
    ];

    protected $casts = [
        'imported_at' => 'datetime',
    ];

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function importedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'imported_by');
    }
}