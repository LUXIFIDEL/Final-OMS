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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_no');
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('Pending');
            $table->string('order');
            $table->string('prin_amount')->nullable();
            $table->string('delivery_fee')->nullable();
            $table->string('feedback_status')->default('0');
            $table->string('feedback_msg')->nullable();
            $table->string('rating')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
};
