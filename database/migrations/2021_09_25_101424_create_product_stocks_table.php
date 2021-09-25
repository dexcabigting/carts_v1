<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('xxsmall')->nullable();
            $table->unsignedInteger('xsmall')->nullable();
            $table->unsignedInteger('small')->nullable();
            $table->unsignedInteger('medium')->nullable();
            $table->unsignedInteger('large')->nullable();
            $table->unsignedInteger('xlarge')->nullable();
            $table->unsignedInteger('xxlarge')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stocks');
    }
}
