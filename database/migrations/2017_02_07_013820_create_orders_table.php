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
            $table->integer('member_id')->unsigned();
            $table->string('title')->default("");
            $table->string('description')->default("");
            $table->string('status')->default("");
            $table->string('merchant_id')->default("");
            $table->string('version')->default("");
            $table->string('response_type')->default("");
            $table->string('check_value')->default("");
            $table->string('time_stamp')->default("");
            $table->string('merchant_order_no')->default("");
            $table->double('amt')->unsigned();
            $table->string('hash_key')->default("");
            $table->string('hash_iv')->default("");
            $table->string('trade_no')->default("");
            $table->string('token_value')->default("");
            $table->string('token_life')->default("");
            $table->text('content_post')->nullable();
            $table->text('content_session')->nullable();
            $table->text('refund_response')->nullable();
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
