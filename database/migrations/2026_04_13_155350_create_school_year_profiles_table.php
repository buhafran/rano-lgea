<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_year_profiles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('pre_primary_enrollment_male')->default(0);
            $table->unsignedInteger('pre_primary_enrollment_female')->default(0);
            $table->unsignedInteger('primary_enrollment_male')->default(0);
            $table->unsignedInteger('primary_enrollment_female')->default(0);
            $table->unsignedInteger('total_teachers_male')->default(0);
            $table->unsignedInteger('total_teachers_female')->default(0);
            $table->unsignedInteger('qualified_teachers')->default(0);
            $table->unsignedInteger('female_teachers')->default(0);
            $table->unsignedInteger('usable_classrooms')->default(0);
            $table->unsignedInteger('total_classrooms')->default(0);
            $table->decimal('pupils_per_classroom', 10, 2)->nullable();
            $table->decimal('pupil_toilet_ratio', 10, 2)->nullable();
            $table->boolean('has_water_source')->nullable();
            $table->boolean('has_health_facility')->nullable();
            $table->unsignedInteger('blackboards_in_good_condition')->default(0);
            $table->unsignedInteger('total_blackboards')->default(0);
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->unique(['school_id', 'academic_session_id'], 'school_year_profiles_school_session_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_year_profiles');
    }
};