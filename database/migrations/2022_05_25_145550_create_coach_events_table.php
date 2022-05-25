<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id');
            $table->foreignId('level_id');
            $table->foreignId('city_id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('document_path')->nullable(true);
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
        Schema::dropIfExists('coach_events');
    }
}
