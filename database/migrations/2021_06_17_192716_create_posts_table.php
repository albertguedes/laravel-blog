<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table)
        {
            $table->id();

            $table->timestamps();

            $table->foreignId('author_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            $table->foreignId('category_id')
                    ->nullable()
                    ->constrained('categories')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            $table->string('title')
                    ->unique();

            $table->text('description');

            $table->text('content');

            $table->text('slug')
                    ->unique();

            $table->boolean('published')
                    ->default(true);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
