<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('students')) return;
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('roll_number', 50)->unique();
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('section_id')->constrained('sections');
            $table->string('guardian_name', 100);
            $table->string('phone', 20);
            $table->text('address');
            $table->date('date_of_admission');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};