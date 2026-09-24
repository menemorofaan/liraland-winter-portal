<?php namespace Liraland\Forum\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateForumTables extends Migration
{
    public function up()
    {
        Schema::create('liraland_forum_categories', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('liraland_forum_channels', function ($table) {
            $table->increments('id');
            $table->integer('category_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->integer('count_topics')->default(0);
            $table->integer('count_posts')->default(0);
            $table->string('last_post_title')->nullable();
            $table->string('last_post_user')->nullable();
            $table->string('last_post_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->integer('bitrix_forum_id')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('liraland_forum_topics', function ($table) {
            $table->increments('id');
            $table->integer('channel_id')->index();
            $table->integer('user_id')->nullable()->index();
            $table->string('author_name')->default('Гість');
            $table->string('title');
            $table->string('slug')->index();
            $table->integer('count_views')->default(0);
            $table->integer('count_posts')->default(1);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_closed')->default(false);
            $table->integer('bitrix_topic_id')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('liraland_forum_posts', function ($table) {
            $table->increments('id');
            $table->integer('topic_id')->index();
            $table->integer('user_id')->nullable()->index();
            $table->string('author_name')->default('Гість');
            $table->longText('content');
            $table->integer('bitrix_message_id')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('liraland_forum_posts');
        Schema::dropIfExists('liraland_forum_topics');
        Schema::dropIfExists('liraland_forum_channels');
        Schema::dropIfExists('liraland_forum_categories');
    }
}
