<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToProductsProductVariantsProductStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('product_variants', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('product_stocks', function (Blueprint $table) {
            //
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
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });

        Schema::table('product_variants', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });

        Schema::table('product_stocks', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
    }
}
