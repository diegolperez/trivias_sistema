<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('users', function (Blueprint $tabla) {
		 	$tabla->increments('id');
            $tabla->string('name');
            $tabla->string('lastname');
            $tabla->string('document',45)->unique();
            $tabla->enum('sexo_persona',['FEMENINO','MASCULINO']);
            $tabla->string('password', 255);
            $tabla->enum('status',['ACTIVE','INACTIVE'])->default("ACTIVE");
            $tabla->rememberToken();
            $tabla->timestamps();
          });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
