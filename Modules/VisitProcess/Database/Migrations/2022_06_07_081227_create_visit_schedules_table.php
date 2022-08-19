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
        Schema::create('visit_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('client_id');
            $table->unsignedBigInteger('schedule_id')->index();
            $table->unsignedBigInteger('outlet_id')->index();
            $table->integer('location_id')->index();
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('gio_lat',50)->nullable();
            $table->string('gio_long',50)->nullable();
            $table->tinyInteger('is_exception')->default(0);
            $table->tinyInteger('visit_type')->default(1)->comment('1=sales_visit, 2=merchandis_visit');
            $table->tinyInteger('visit_status')->default(0)->comment('0=nonvisit,1=visited');
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
        Schema::dropIfExists('visit_schedules');
    }
};
