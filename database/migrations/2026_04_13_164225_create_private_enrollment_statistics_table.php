<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('private_enrollment_statistics', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();
            $table->string('lga_name');
            $table->string('level');
            $table->unsignedInteger('male')->default(0);
            $table->unsignedInteger('female')->default(0);
            $table->unsignedInteger('total')->default(0);
            $table->string('source_document')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->index(['academic_session_id', 'level'], 'private_enrollment_stats_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('private_enrollment_statistics');
    }
};