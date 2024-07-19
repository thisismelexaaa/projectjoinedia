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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('nama');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('type')->default('gratis');
            $table->string('organizer');
            $table->string('status');
            $table->string('image')->nullable();
            $table->string('kategori');
            $table->string('location');
            $table->text('description');
            $table->string('level');
            $table->double('price')->default(0);
            $table->integer('kuota')->default(150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
