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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id');
            $table->foreign('students_id')->on('students')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('courses_id');
            $table->foreign('courses_id')->on('courses')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('semester', 5)->nullable(false);
            $table->decimal('course_grade', 3, 0)->unsigned()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
