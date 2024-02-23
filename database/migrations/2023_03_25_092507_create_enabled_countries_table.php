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
        Schema::create('enabled_countries', function (Blueprint $table) {
            $table->id();

            $table->integer('lc_country_id')
                ->unsigned();
            $table->foreign('lc_country_id')
                ->references('id')
                ->on('lc_countries');

            $table->double('exchange_rate')->default(0);
            $table->double('shipping_rate')->default(0);

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
        Schema::dropIfExists('enabled_countries');
    }
};
