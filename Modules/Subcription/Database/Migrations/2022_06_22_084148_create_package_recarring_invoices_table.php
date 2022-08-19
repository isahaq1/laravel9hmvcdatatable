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
        Schema::create('package_recarring_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('client_id');
            $table->string('title');
            $table->double('price');
            $table->integer('duration');
            $table->integer('offer')->nullable();
            $table->double('offer_price')->nullable();
            $table->integer('offer_duration')->nullable();
            $table->tinyinteger('offer_status')->default();
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->date('bill_start_date')->nullable();
            $table->date('invoice_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_recarring_invoices');
    }
};
