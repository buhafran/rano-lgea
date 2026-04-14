<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('population_statistics', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('ward_id')->nullable()->constrained()->nullOnDelete();
            $table->string('lga_name')->nullable();
            $table->foreignId('academic_session_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedTinyInteger('age')->nullable();
            $table->enum('gender', ['male', 'female', 'total'])->default('total');
            $table->unsignedInteger('population')->default(0);
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->index(['academic_session_id', 'age', 'gender'], 'population_statistics_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('population_statistics');
    }
};