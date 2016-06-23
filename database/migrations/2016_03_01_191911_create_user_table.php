<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appUser', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100);
            $table->string('password');
            $table->double('regularRate', 5, 2);
            $table->double('overtimeRate', 5, 2);
            $table->tinyInteger('admin')->default(0);
            $table->rememberToken();
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
        Schema::drop('appUser');
    }
}
