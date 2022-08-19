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
        Schema::create('visit_order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->index();
            $table->integer('client_id')->index();
            $table->integer('product_id')->index();
            $table->integer('brand_id')->index();
            $table->integer('product_category_id');
            $table->integer('unit_per_case')->nullable();
            $table->integer('order_case_qty')->nullable();
            $table->integer('order_unit_qty')->nullable();
            $table->integer('case_qty')->nullable();
            $table->integer('unit_qty')->nullable();
            $table->float('price',8,2);
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
        Schema::dropIfExists('visit_order_details');
    }
};
