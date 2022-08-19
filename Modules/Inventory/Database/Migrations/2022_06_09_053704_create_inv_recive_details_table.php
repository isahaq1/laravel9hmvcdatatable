<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_recive_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('recive_id');
            $table->integer('product_id');
            $table->integer('case_qty');
            $table->integer('unit_qty');
            $table->integer('unit_price');
            $table->integer('trade_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_recive_details');
    }
};
