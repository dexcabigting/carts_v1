<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteExtraColumnsOnTshirtDetails extends Migration
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
            $table->dropColumn('created_date');
            $table->dropColumn('updated_date');
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
            $table->date('created_date');
            $table->date('updated_date');
        });
    }
}
