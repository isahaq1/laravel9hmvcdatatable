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
        Schema::create('visit_posms_visibilities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->unsignedBigInteger('schedule_id')->index();
            $table->unsignedBigInteger('outlet_id')->index();
            $table->integer('outlet_channel_id')->index();
            $table->integer('outlet_type_id')->index();
            $table->integer('country_id')->index();
            $table->integer('region_id')->index();
            $table->integer('state_id')->index();
            $table->integer('location_id')->index();
            $table->integer('client_id')->index();
            $table->integer('posms_product_id');
            $table->integer('posms_product_qty')->nullable();
            $table->integer('product_available')->nullable();
            $table->integer('product_deployed')->nullable();
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
        Schema::dropIfExists('visit_posms_visibilities');
    }
};
