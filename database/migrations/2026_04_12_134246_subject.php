<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->foreignId('school_level_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_core')->default(false);
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            $table->unique(['name', 'school_level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
