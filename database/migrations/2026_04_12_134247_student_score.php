<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_scores', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('term_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_level_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->decimal('ca_score', 6, 2)->default(0);
            $table->decimal('exam_score', 6, 2)->default(0);
            $table->decimal('total_score', 6, 2)->default(0);
            $table->string('grade', 10)->nullable();
            $table->string('remark', 100)->nullable();
            $table->unsignedBigInteger('entered_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->unique(
                ['student_id', 'academic_session_id', 'term_id', 'class_level_id', 'subject_id'],
                'student_scores_unique_result'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_scores');
    }
};
