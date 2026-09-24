<?php

use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
    Schema::create('liraland_software_distributives', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('version');
        $table->string('os')->default('Windows');
        $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('liraland_software_distributives');
    }
};
