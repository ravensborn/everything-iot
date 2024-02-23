<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('author_id')
                ->nullable();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');

            $table->unsignedBigInteger('category_id');

            $table->string('locale')->default(config()->get('app.locale'));

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');

            $table->string('title');
            $table->string('slug');

            $table->boolean('is_commentable')->default(false);
            $table->boolean('is_hidden')->default(false);

            $table->text('short_content')->nullable();

            $table->text('content')->nullable();
            $table->timestamps();
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
};
