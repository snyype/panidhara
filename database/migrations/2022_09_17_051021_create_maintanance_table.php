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
        Schema::create('maintanance', function (Blueprint $table) {
            $table->id();
            $table->string("house_number");
            $table->string('comment');
            $table->string('user_id');
            $table->string('user_name');
            $table->string('latitude');
            $table->string('longitude');
            $table->date('date');
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
        Schema::dropIfExists('maintanance');
    }
};
