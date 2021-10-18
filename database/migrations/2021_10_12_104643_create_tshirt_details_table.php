<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTshirtDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tshirt_details', function (Blueprint $table) {
            $table->id();
            $table->longText('customer_name');
            $table->longText('tshirt_front')->nullable();
            $table->longText('tshirt_back')->nullable();
            $table->longText('tshirt_measurements')->nullable();
            $table->longText('tshirt_fabric')->nullable();
            $table->longText('tshirt_type')->nullable();
            $table->longText('tshirt_color')->nullable();
            $table->longText('tshirt_pdf')->nullable();
            $table->date('created_date');
            $table->date('updated_date');
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
        Schema::dropIfExists('tshirt_details');
    }
}
