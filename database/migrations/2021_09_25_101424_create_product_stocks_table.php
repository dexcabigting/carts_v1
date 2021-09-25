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
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('xxsmall')->nullable()->default(0);
            $table->unsignedInteger('xsmall')->nullable()->default(0);
            $table->unsignedInteger('small')->nullable()->default(0);
            $table->unsignedInteger('medium')->nullable()->default(0);
            $table->unsignedInteger('large')->nullable()->default(0);
            $table->unsignedInteger('xlarge')->nullable()->default(0);
            $table->unsignedInteger('xxlarge')->nullable()->default(0);
            $table->timestamps();
          
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
