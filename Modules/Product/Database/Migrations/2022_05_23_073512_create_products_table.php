<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('client_id');
            $table->integer('brand_id');
            $table->integer('create_by');
            $table->string('product_name',50);
            $table->string('product_weight',50)->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_short_code',50)->nullable();
            $table->string('product_image',50)->nullable();
            $table->integer('rec_retail_price')->nullable();
            $table->integer('unit_per_case')->nullable();
            $table->float('unit_price', 8,2)->nullable();
            $table->float('sales_price', 8,2)->nullable();
            $table->float('case_discount',8,2)->nullable();
            $table->tinyInteger('p_type')->default(1)->comment('1=product, 2=pos_product');
            $table->string('reorder_level_qty',50)->nullable();
            $table->integer('mst_qty')->nullable();
            $table->integer('outlet_type_id')->nullable();
            $table->tinyInteger('active_status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
