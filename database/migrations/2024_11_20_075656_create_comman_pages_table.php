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
        Schema::create('comman_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        DB::table('comman_pages')->insert([
            [
                'title' => 'Winner Circle',
                'slug' => 'winner-circle',
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-onditions', // Fixed the 'email' typo to 'slug'
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comman_pages');
    }
};
