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
        Schema::create('inv_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('store_id');
            $table->integer('product_id');
            $table->integer('stock_case_qty')->nullable();
            $table->integer('stock_unit_qty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_stocks');
    }
};
