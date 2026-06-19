<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('fee_structure')) return;
        Schema::create('fee_structure', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('term_id')->constrained('terms');
            $table->decimal('tuition_fee', 10, 2);
            $table->decimal('lab_fee', 10, 2)->default(0);
            $table->decimal('library_fee', 10, 2)->default(0);
            $table->decimal('sports_fee', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->unique(['class_id', 'term_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structure');
    }
};