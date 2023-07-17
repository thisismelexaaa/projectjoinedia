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
            $table->string('eventname');
            $table->datetime('eventdate');
            $table->string('eventtype')->default('gratis');
            $table->string('eventorganizer');
            $table->string('eventstatus');
            $table->string('eventimage');
            $table->string('eventkategori');
            $table->string('eventlocation');
            $table->text('eventdescription');
            $table->double('eventprice')->default(0);
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
