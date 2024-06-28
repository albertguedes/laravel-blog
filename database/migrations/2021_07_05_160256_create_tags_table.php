<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {

            $table->id();

            $table->timestamps();

            $table->boolean('is_active')
                  ->default(true);

            $table->string('title')
                  ->unique();

            $table->text('slug')
                  ->unique();

            $table->text('description');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['post_id']);
        });

        Schema::dropIfExists('tags');
    }
}
