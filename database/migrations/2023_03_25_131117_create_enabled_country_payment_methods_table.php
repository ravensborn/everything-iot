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
        Schema::create('enabled_country_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enabled_country_id');
            $table->foreign('enabled_country_id')
                ->references('id')
                ->on('enabled_countries');

            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods');
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
        Schema::dropIfExists('enabled_country_payment_methods');
    }
};
