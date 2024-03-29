<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->id();

            $table->timestamps();

            $table->unsignedBigInteger('parent_id')
                  ->nullable()
                  ->default(null);

            $table->boolean('is_active')
                  ->default(true);

            $table->string('title')
                  ->unique();

            $table->text('slug')
                  ->unique();

            $table->text('description');

            $table->foreign('parent_id')
                  ->references('id')
                  ->on('categories')
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
        Schema::dropIfExists('categories');
    }
}
