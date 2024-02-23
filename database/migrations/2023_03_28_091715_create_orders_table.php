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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('number');

            $table->string('name')->nullable();

            $table->integer('status')->default(\App\Models\Order::STATUS_PENDING);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
                ->cascadeOnDelete();

            $table->integer('lc_country_id')
                ->unsigned();
            $table->foreign('lc_country_id')
                ->references('id')
                ->on('lc_countries');

            $table->json('shipping_address');
            $table->json('billing_address');

            $table->string('discount_type')->nullable();
            $table->double('discount_amount')->default(0);

            $table->double('shipping_rate')->default(0);
            $table->double('exchange_rate')->default(0);

            $table->string('promo_code')->nullable();
            $table->double('promo_code_discount_value')->default(0);

            $table->double('total');

            $table->longText('note')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
