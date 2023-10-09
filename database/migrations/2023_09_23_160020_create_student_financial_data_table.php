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
        Schema::create('student_financial_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id');
            $table->foreign('students_id')->on('students')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['Deposit', 'Withdraw']);
            $table->string('message');
            $table->string('semester', 5)->nullable(false);
            $table->decimal('total_amount_required', 7, 2)->unsigned()->nullable(false);
            $table->decimal('total_amount_paid', 7, 2)->unsigned()->nullable(false);
            $table->decimal('total_amount_payable', 7, 2)->unsigned()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_financial_data');
    }
};
