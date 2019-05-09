<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quantity');

            $table->unsignedBigInteger('bill_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_product');
    }
}
