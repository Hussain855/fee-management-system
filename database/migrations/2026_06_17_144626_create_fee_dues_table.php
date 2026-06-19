<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('fee_dues')) return;
        Schema::create('fee_dues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('fee_structure_id')->constrained('fee_structure');
            $table->foreignId('term_id')->constrained('terms');
            $table->decimal('amount_due', 10, 2);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->decimal('outstanding_balance', 10, 2)->nullable();
            $table->enum('status', ['Pending', 'Partially Paid', 'Paid', 'Overdue'])->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_dues');
    }
};