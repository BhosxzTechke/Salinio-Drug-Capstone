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
                // Add 'cancelled' to the status enum
                DB::statement("ALTER TABLE purchase_orders 
                    MODIFY status ENUM('draft','confirmed','sent','partially_received','received','cancelled') 
                    NOT NULL DEFAULT 'draft'");
            }

            public function down()
            {
                // Revert back to the original enum without 'cancelled'
                DB::statement("ALTER TABLE purchase_orders 
                    MODIFY status ENUM('draft','confirmed','sent','partially_received','received') 
                    NOT NULL DEFAULT 'draft'");
            }

};
