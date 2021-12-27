<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToOrdersOrderVariantsOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('order_variants', function (Blueprint $table) {
            //
            $table->softDeletes();
        });

        Schema::table('order_items', function (Blueprint $table) {
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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });

        Schema::table('order_variants', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });

        Schema::table('order_items', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
    }
}
