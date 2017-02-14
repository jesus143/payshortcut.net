<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('email')->unique();
            $table->string('telephone')->default('');
            $table->string('country')->default('');
            $table->string('post_code')->default('');
            $table->string('address')->default('');
            $table->string('look_up')->default(''); // 抬頭
            $table->string('uniform_number')->default(''); // 統一編號
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
        Schema::dropIfExists('members');
    }
}
