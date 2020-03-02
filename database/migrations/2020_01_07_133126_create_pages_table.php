<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('parent_id')->default(0);
            $table->uuid('webshop_category_id')->default(0);
            $table->string('title');
            $table->longText('content');
            $table->longText('template');
            $table->text('hyperlink')->nullable();
            $table->string('slug')->nullable();
            $table->longText('seo')->nullable();
            $table->string('navigation_image')->nullable();
            $table->integer('sort')->default(0);
            $table->tinyInteger('show_on_home')->default(0);
            $table->tinyInteger('show_in_menu')->default(1);
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
        Schema::dropIfExists('pages');
    }
}
