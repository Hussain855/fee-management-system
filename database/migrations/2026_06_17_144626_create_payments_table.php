<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('payments')) return;
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_due_id')->constrained('fee_dues');
            $table->foreignId('student_id')->constrained('students');
            $table->decimal('amount_paid', 10, 2);
            $table->dateTime('payment_date');
            $table->enum('payment_method', ['Cash', 'Bank Transfer', 'Online']);
            $table->boolean('is_partial')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};