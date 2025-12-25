<?php declare(strict_types=1);

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
        Schema::create('post_tag', function (Blueprint $table)
        {
            $table->timestamp('created_at')
                    ->useCurrent();

            $table->foreignId('post_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            $table->foreignId('tag_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            $table->unique(['post_id', 'tag_id']);
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
