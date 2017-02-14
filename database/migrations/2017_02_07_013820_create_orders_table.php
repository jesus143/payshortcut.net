<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('status');
            $table->string('merchant_id');
            $table->string('version'); 
            $table->string('response_type'); 
            $table->string('check_value'); 
            $table->dateTime('time_stamp');
            $table->string('merchant_order_no');
            $table->double('amt'); 
            $table->string('hash_key'); 
            $table->string('hash_iv'); 
            $table->string('trade_no'); 
            $table->string('token_value');
            $table->string('token_life');
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
        Schema::dropIfExists('orders');
    }
}
