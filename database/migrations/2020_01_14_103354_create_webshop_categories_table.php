<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebshopCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webshop_categories', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('parent_id')->default(0);
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('webshop_categories');
    }
}
