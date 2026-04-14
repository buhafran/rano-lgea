<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('term_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('class_level_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_new_intake')->default(false);
            $table->unsignedTinyInteger('entry_age')->nullable();
            $table->enum('enrollment_status', ['active', 'transferred', 'graduated', 'repeated', 'dropped_out'])->default('active');
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'academic_session_id', 'class_level_id'], 'enrollment_student_session_class_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};