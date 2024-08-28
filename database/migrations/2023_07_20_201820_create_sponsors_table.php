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
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade')->nullable();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description');
            $table->Date('start_date');
            $table->Date('end_date');
=======
            $table->string('event_id');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description');
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
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
