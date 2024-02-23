<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('cover_image')->nullable();

            $table->boolean('is_hidden')->default(false);

            $table->integer('lc_country_id')->unsigned();
            $table->foreign('lc_country_id')
                ->references('id')
                ->on('lc_countries');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('restrict');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')
                ->on('brands')->onDelete('restrict');


            $table->unsignedBigInteger('promo_code_id')->nullable();
            $table->foreign('promo_code_id')
                ->references('id')
                ->on('promo_codes')
                ->onDelete('set null');

            $table->double('price');
            $table->double('previous_price')->default(0);

            $table->json('additional_fees')->nullable();
            $table->json('properties')->nullable();

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
        Schema::dropIfExists('products');
    }
};
