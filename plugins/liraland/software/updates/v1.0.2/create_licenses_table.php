<?php namespace Liraland\Software\Updates;

use Winter\Storm\Database\Updates\Migration;
use Schema;

class CreateLicensesTable extends Migration
{
    public function up()
    {
        Schema::create('liraland_software_licenses', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('license_key')->unique();
            $table->string('software_name'); // Например: ЛІРА-САПР 2024, САПФІР PRO
            $table->string('client_name');   // Клиент или организация
            $table->string('client_email');
            $table->string('type')->default('subscription'); // 'subscription' или 'dongle'
            $table->string('dongle_id')->nullable();         // Номер USB-ключа CodeMeter
            $table->date('expires_at')->nullable();          // Для подписок
            $table->string('status')->default('active');     // active, expired, suspended
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liraland_software_licenses');
    }
}