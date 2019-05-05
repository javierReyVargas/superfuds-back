<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->string('name');
            $table->unsignedBigInteger('quantity')->unsigned();
            $table->string('price');
            $table->string('numLot');
            $table->string('expirationDate');
            $table->mediumText('description')->nullable();
            $table->string('status')->default('0');
            $table->string('image')->default('image.png');
            $table->timestamps();


            $table->foreign('provider_id')->references('id')->on('users');

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
}
