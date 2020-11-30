<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('cedula')->unsigned();
            $table->date('birthday');
            $table->enum('gender', ['f', 'm']);
            $table->string('client', 100);
            $table->enum('headquarter', ["Ruta N", "Puerto Seco", "Buro"]);
            $table->bigInteger('user_id')->unsigned();
            $table->integer('age')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advisers');
    }
}
