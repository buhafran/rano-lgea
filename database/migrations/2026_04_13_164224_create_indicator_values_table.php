<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicator_values', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('indicator_definition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('term_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ward_id')->nullable()->constrained()->nullOnDelete();
            $table->string('lga_name')->nullable();
            $table->decimal('male_value', 12, 2)->nullable();
            $table->decimal('female_value', 12, 2)->nullable();
            $table->decimal('total_value', 12, 2)->nullable();
            $table->enum('source', ['computed', 'imported', 'manual'])->default('computed');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->index(['indicator_definition_id', 'academic_session_id', 'term_id'], 'indicator_values_main_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicator_values');
    }
};