<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('classes')) return;
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->integer('grade_level')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};