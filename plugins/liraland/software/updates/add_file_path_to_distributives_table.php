<?php namespace Liraland\Software\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class AddFilePathToDistributivesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('liraland_software_distributives')) {
            Schema::table('liraland_software_distributives', function ($table) {
                if (!Schema::hasColumn('liraland_software_distributives', 'file_path')) {
                    $table->string('file_path')->nullable()->after('version');
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('liraland_software_distributives')) {
            Schema::table('liraland_software_distributives', function ($table) {
                if (Schema::hasColumn('liraland_software_distributives', 'file_path')) {
                    $table->dropColumn('file_path');
                }
            });
        }
    }
}
