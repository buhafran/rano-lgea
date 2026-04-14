<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('annual_census_imports', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('academic_session_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->string('import_type')->nullable();
            $table->unsignedBigInteger('imported_by')->nullable();
            $table->timestamp('imported_at')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->index(['academic_session_id', 'import_type'], 'annual_census_imports_lookup_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annual_census_imports');
    }
};