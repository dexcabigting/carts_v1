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
            $table->longText('tshirt_jersey_measurements')->nullable();
            $table->longText('tshirt_short_measurements')->nullable();
            $table->longText('tshirt_fabric')->nullable();
            $table->longText('tshirt_type')->nullable();
            $table->longText('tshirt_color')->nullable();
            $table->longText('tshirt_pdf')->nullable();
            $table->float('custom_price')->default(0);
            $table->boolean('is_approve')->default(false);
            $table->longText('custom_note')->nullable();
            $table->date('custom_estimate_delivery')->nullable();
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
