<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create("exports", function (Blueprint $table) {
			$table->id();

			$table->string("type");

			$table
				->foreignId("user_id")
				->constrained()
				->cascadeOnDelete()
				->restrictOnUpdate();

			$table->string("timezone");

			$table->dateTime("requested_at");

			$table->dateTime("processed_at")->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists("exports");
	}
};
