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
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // linked to orders
            $table->string('reason');
            $table->text('description')->nullable();
            $table->integer('quantity')->default(1);
            $table->enum('status', ['pending', 'approved', 'in_transit', 'received', 'refunded', 'rejected'])->default('pending');
            $table->json('photos')->nullable(); // optional images
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
        Schema::dropIfExists('return_requests');
    }
};
