<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('department_id')
                ->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            
            $table->string('event_mode');

            $table->foreignId('location_id')
                ->nullable()
                ->constrained()
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->date('date');
            $table->time('time');

            $table->foreignId('chair_id')
                ->constrained('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();      

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
