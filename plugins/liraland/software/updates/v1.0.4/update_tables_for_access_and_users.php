<?php namespace Liraland\Software\Updates;

use Winter\Storm\Database\Updates\Migration;
use Schema;

class UpdateTablesForAccessAndUsers extends Migration
{
    public function up()
    {
        if (Schema::hasTable('liraland_software_distributives')) {
            Schema::table('liraland_software_distributives', function ($table) {
                if (!Schema::hasColumn('liraland_software_distributives', 'access_level')) {
                    $table->string('access_level')->default('public');
                }
            });
        }

        if (Schema::hasTable('liraland_software_licenses')) {
            Schema::table('liraland_software_licenses', function ($table) {
                if (!Schema::hasColumn('liraland_software_licenses', 'user_id')) {
                    $table->integer('user_id')->unsigned()->nullable();
                }
            });
        }
    }

    public function down()
    {
    }
}
