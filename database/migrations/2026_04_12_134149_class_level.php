<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('class_levels', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0); 
        //  $table->foreignId('school_level_id')->nullable()->constrained()->nullOnDelete();

            $table->unsignedBigInteger('createdby')->nullable();
            $table->unsignedBigInteger('updatedby')->nullable();
            $table->timestamps();

            // $table->unique(['name', 'school_level_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_levels');
    }
};
