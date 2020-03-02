<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webshop_order_rules', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('order_id');
            $table->uuid('user_id');
            $table->uuid('product_id');
            $table->integer('qty')->default(1);
            $table->decimal('price')->default(0);
            $table->longText('options')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('webshop_order_rules');
    }
}
