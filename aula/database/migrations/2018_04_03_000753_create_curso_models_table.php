<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoModelsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('curso_models', function (Blueprint $table) {
				$table->increments('id');
				$table->string('nome');
				$table->string('abreviatura');
				$table->integer('id_nivel');
				$table->integer('tempo');
				$table->string('ativo');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('curso_models');
	}
}
