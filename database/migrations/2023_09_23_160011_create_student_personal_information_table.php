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
        Schema::create('student_personal_information', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('students_id');
            $table->foreign('students_id')->on('students')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nid', 8)->nullable(true)->unique()->default('12345678');
            $table->string('address', 191)->nullable(false)->default('Gaza-Gaza-Gaza-Gaza-Gaza');
            $table->string('mobile', 25)->unique()->nullable(false)->default('+970569696969');
            $table->enum('gender', ['Male', 'Female'])->default('Male')->nullable(true);
            $table->date('birthday')->default(now()->format('Y-m-d'))->nullable(true)->default('2000-01-01');
            $table->longText('accomplishments')->nullable();
            $table->string('study_level')->nullable(false)->default('100');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_personal_information');
    }
};
