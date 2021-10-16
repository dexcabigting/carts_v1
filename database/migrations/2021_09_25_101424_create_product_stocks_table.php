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
            $table->unsignedInteger('2XS')->nullable()->default(0);
            $table->unsignedInteger('XS')->nullable()->default(0);
            $table->unsignedInteger('S')->nullable()->default(0);
            $table->unsignedInteger('M')->nullable()->default(0);
            $table->unsignedInteger('L')->nullable()->default(0);
            $table->unsignedInteger('XL')->nullable()->default(0);
            $table->unsignedInteger('2XL')->nullable()->default(0);
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
        Schema::dropIfExists('product_stocks');
    }
}
