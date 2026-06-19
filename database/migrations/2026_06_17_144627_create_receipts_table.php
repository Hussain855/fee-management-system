<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('receipts')) return;
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->unique()->constrained('payments');
            $table->foreignId('student_id')->constrained('students');
            $table->string('receipt_number', 100)->unique();
            $table->dateTime('issue_date');
            $table->decimal('total_paid', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};