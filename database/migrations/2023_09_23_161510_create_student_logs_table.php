<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id');
            $table->foreign('students_id')->on('students')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_logs');
    }
};
