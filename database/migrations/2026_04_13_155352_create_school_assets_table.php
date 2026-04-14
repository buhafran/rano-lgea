<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_assets', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
            $table->foreignId('asset_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_session_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('functional_quantity')->default(0);
            $table->enum('condition', ['good', 'fair', 'poor'])->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->unique(
                ['school_id', 'asset_type_id', 'academic_session_id'],
                'school_assets_school_type_session_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_assets');
    }
};