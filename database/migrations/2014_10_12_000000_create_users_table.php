<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('firstname');
            $table->string('preposition')->nullable();
            $table->string('lastname');
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('telephone')->nullable();
            $table->integer('other_delivery')->default(0);
            $table->string('delivery_street')->nullable();
            $table->string('delivery_house_number')->nullable();
            $table->string('delivery_zipcode')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('webuser');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'firstname' => 'Sven',
            'preposition' => 'van',
            'lastname' => 'Spelden',
            'email' => 'info@vanspelden.nl',
            'password' => '$2y$10$V1w1IsC0CliR6W/1DD31TOsKuBEIF6ZE9zw4AI7XX1dBijZWYM11a',
            'role' => 'admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
