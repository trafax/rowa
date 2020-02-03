<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebshopProductFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webshop_filter_webshop_product', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('webshop_product_id');
            $table->uuid('webshop_filter_id');
            $table->string('value')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('fixed_price')->default(0);
            $table->decimal('added_price')->default(0);
            $table->integer('sort')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webshop_filter_webshop_product');
    }
}
