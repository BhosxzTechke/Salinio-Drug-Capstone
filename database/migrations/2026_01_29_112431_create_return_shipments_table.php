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
        Schema::create('return_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('return_request_id'); // linked to return_requests
            $table->string('tracking_number')->nullable();
            $table->enum('shipment_status', ['ready_for_pickup', 'picked_up', 'in_transit', 'delivered'])->default('ready_for_pickup');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            $table->foreign('return_request_id')->references('id')->on('return_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_shipments');
    }
};
