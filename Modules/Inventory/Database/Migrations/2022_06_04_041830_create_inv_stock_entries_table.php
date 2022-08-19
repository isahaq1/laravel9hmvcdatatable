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
        Schema::create('inv_stock_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->integer('store_id');
            $table->integer('entry_by');
            $table->integer('product_id');
            $table->double('stock', 10, 2);
            $table->float('stock_in', 8, 2);
            $table->float('stock_out', 8, 2);
            $table->float('stock_adjust_in', 8, 2);
            $table->float('stock_adjust_out', 8, 2);
            $table->integer('type')->default(0)->comment('1=batch stock, 2=checkout, 3=checkin');
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
        Schema::dropIfExists('inv_stock_entries');
    }

    
};
