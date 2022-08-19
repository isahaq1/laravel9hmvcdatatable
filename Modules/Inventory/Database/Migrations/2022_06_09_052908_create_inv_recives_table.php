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
        Schema::create('inv_recives', function (Blueprint $table) {
            $table->id();
            $table->string('mrr_no',100);
            $table->integer('client_id');
            $table->integer('store_id');
            $table->string('description')->nullable();
            $table->date('receive_date');
            $table->tinyInteger('status')->default(0)->comment('0=unaprove,1=approve');
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
        Schema::dropIfExists('inv_recives');
    }
};
