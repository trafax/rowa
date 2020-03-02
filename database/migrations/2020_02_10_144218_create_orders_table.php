<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webshop_orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id');
            $table->string('order_nr');
            $table->string('paymentMethod')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('price_sub_total')->default(0);
            $table->decimal('price_shipping')->default(0);
            $table->decimal('price_total')->default(0);
            $table->longText('invoice_address');
            $table->longText('delivery_address');
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webshop_orders');
    }
}
