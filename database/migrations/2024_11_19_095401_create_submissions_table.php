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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('competitionId')->default(0);
            $table->string('fullName')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('emailAddress')->nullable();
            $table->string('videoFile')->nullable();
            $table->string('status')->default('pending');
            $table->string('isWinner')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
