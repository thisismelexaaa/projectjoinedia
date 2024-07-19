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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->constrained('users')->onDelete('cascade')->nullable();
            $table->string('event_id')->constrained('events')->onDelete('cascade')->nullable();
            $table->string('nama');
            $table->string('email');
            $table->string('username');
            $table->string('type');
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->string('tiket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
