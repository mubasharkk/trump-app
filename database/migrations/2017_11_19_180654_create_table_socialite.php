<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSocialite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_socialite', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('driver');
            $table->string('username');
            $table->string('email');
            $table->string('token');
            $table->json('user_object')->nullable();
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
        Schema::drop('users_socialite');
    }
}
