<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicator_definitions', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('formula')->nullable();
            $table->enum('level', ['school', 'lga', 'state'])->default('lga');
            $table->enum('data_type', ['integer', 'decimal', 'percentage', 'ratio'])->default('decimal');
            $table->boolean('is_calculated')->default(true);
            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicator_definitions');
    }
};