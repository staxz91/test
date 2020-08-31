<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProxyTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_test', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ip_address', 200);
            $table->integer('port')->default(80);
            $table->string('username', 200)->nullable();
            $table->string('password')->nullable();
            $table->text('url');
            $table->string('status', 200)->nullable();
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::drop('proxy_test');
    }
}
