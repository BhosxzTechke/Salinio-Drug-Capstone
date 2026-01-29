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
        Schema::table('orders', function (Blueprint $table) {

                $table->string('delivery_status', 50)
                    ->default('pending')
                    ->after('payment_status');

                $table->unsignedBigInteger('rider_id')
                    ->nullable()
                    ->after('delivery_status');

                $table->timestamp('assigned_at')
                    ->nullable()
                    ->after('rider_id');

                $table->timestamp('delivered_at')
                    ->nullable()
                    ->after('assigned_at');

                $table->foreign('rider_id')
                    ->references('id')
                    ->on('riders')
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropForeign(['rider_id']);

            $table->dropColumn([
                'delivery_status',
                'rider_id',
                'assigned_at',
                'delivered_at',
            ]);
        });
    }
};
