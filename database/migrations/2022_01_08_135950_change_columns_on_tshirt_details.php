<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsOnTshirtDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tshirt_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('customer_name')->change();
            $table->renameColumn('customer_name', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tshirt_details', function (Blueprint $table) {
            //
        });
    }
}
