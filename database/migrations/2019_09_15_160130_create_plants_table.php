<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePlantsTable.
 */
class CreatePlantsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plants', function(Blueprint $table) {
            $table->increments('id');
						$table->unsignedInteger('institution_id');
						$table->string('name', 45);
						$table->text('description');

            $table->timestampsTz();
						$table->softDeletes();

						$table->foreign('institution_id')->references('id')->on('institutions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('plants');
	}
}
