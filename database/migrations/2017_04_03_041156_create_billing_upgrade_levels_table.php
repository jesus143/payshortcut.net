<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingUpgradeLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_upgrade_levels', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('email')->nullable(); 
            $table->integer('level')->unsigned();  
            $table->integer('order_id')->unsigned();  
            $table->string('status')->default('active');  
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
        Schema::dropIfExists('billing_upgrade_levels');
    }
}
