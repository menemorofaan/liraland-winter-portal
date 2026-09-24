<?php namespace Liraland\Software\Updates;

use Winter\Storm\Database\Updates\Migration;
use Schema;

class AddIsPublishedToDistributives extends Migration
{
    public function up()
    {
        if (Schema::hasTable('liraland_software_distributives')) {
            Schema::table('liraland_software_distributives', function ($table) {
                if (!Schema::hasColumn('liraland_software_distributives', 'is_published')) {
                    $table->boolean('is_published')->default(true);
                }
            });
        }
    }

    public function down()
    {
    }
}
