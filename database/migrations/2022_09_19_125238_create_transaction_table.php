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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('transaction_state');
            $table->integer('amount');
            $table->integer('fee_amount');
            $table->string('meter_id'); 
            $table->string('meter_name');
            $table->string('payment_type');
            $table->string('user_name');
            $table->string('user_phone')->nullable();
            $table->string('remarks')->nullable();
            $table->string('refunded')->nullable();
            $table->integer('cashback');
            $table->string('token');
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
        Schema::dropIfExists('transaction');
    }
};
