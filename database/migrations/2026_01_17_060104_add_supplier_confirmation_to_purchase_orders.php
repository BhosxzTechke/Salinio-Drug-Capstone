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


            Schema::table('purchase_orders', function (Blueprint $table) {
                $table->uuid('supplier_confirmation_token')->nullable()->unique();
                $table->timestamp('supplier_confirmed_at')->nullable();
                $table->date('expiration_date')->nullable();
            });

            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            //
        });
    }
};
