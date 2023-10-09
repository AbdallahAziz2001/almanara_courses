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
        Schema::create('students', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name', 50)->nullable(false);
            $table->string('last_name', 50)->nullable(false);
            $table->string('email', 191)->unique()->nullable(false);
            $table->string('password', 64)->nullable(false);
            $table->string('account_picture', 125)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
