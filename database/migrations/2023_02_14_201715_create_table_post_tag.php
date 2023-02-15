<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePostTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('table_post_tag', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at');
            $table->unsignedBigInteger('post_id')
                  ->nullable()
                  ->default(null);
            $table->foreign('post_id')
                  ->references('id')
                  ->on('posts')
                  ->onDelete('set null');
            $table->unsignedBigInteger('tag_id')
                  ->nullable()
                  ->default(null);
            $table->foreign('tag_id')
                  ->references('id')
                  ->on('tags')
                  ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_post_tag');
    }
}
