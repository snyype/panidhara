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
        Schema::create('newconnection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string("user_name");
            $table->string("name");
            $table->string("address");
            $table->string("number");
            $table->string("citizenship_number");
            $table->string("house_number");
            $table->string('latitude');
            $table->string('longitude');
            $table->string("status")->default('pending');
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
        Schema::dropIfExists('newconnection');
    }
};
