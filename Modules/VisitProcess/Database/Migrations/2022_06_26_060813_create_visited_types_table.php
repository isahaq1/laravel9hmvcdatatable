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
        Schema::create('visited_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->tinyInteger('outlet_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('merchandising_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('posm_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('competition_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('freshness_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('oos_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('planogram_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('pricing_visit')->default(0)->comment('1=visited,0=no visit');
            $table->tinyInteger('ordering_visit')->default(0)->comment('1=visited,0=no visit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visited_types');
    }
};
