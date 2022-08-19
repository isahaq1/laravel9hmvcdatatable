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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checkout_id');
            $table->integer('user_id');
            $table->integer('store_id');
            $table->integer('client_id');
            $table->integer('checkout_by');
            $table->string('checkout_note')->nullable();
            $table->tinyInteger('is_confirm')->default(0)->comment('0=not confirm, 1=confirm');
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
        Schema::dropIfExists('checkouts');
    }
};
