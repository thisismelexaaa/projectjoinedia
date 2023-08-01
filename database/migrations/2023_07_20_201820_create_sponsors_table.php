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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('event_id');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description');
=======
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade')->nullable();
            $table->string('name');
            $table->string('logo');
            $table->string('description');
            $table->Date('start_date');
            $table->Date('end_date');
>>>>>>> 8019b8b (70% Progress)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
