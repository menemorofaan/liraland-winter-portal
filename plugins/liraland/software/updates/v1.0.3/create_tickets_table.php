<?php namespace Liraland\Software\Updates;

use Winter\Storm\Database\Updates\Migration;
use Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('liraland_software_tickets', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ticket_number')->unique();
            $table->string('subject');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('product');
            $table->string('priority')->default('normal');
            $table->string('status')->default('new');
            $table->integer('assigned_to_id')->unsigned()->nullable();
            $table->text('message');
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liraland_software_tickets');
    }
}
