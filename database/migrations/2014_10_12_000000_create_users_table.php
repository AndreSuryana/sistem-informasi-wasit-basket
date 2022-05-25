<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')->default(1);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('full_name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('phone');
            $table->string('address');
            $table->foreignId('city_id');
            $table->string('other_profession')->nullable(true);
            $table->string('photo_path');
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
        Schema::dropIfExists('users');
    }
}
