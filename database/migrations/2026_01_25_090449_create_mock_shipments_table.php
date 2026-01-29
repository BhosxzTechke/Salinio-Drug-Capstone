<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mock_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // link to orders table
            $table->string('tracking_number')->unique();
            $table->enum('delivery_status', ['ready_for_shipment', 'picked_up', 'out_for_delivery', 'delivered'])->default('ready_for_shipment');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mock_shipments');
    }
};
