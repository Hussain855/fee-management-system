<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('fines')) return;
        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_due_id')->constrained('fee_dues');
            $table->foreignId('student_id')->constrained('students');
            $table->decimal('fine_amount', 10, 2);
            $table->string('reason', 255)->default('Late Payment');
            $table->date('applied_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};