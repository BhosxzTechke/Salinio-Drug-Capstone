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
        public function up(): void
        {
            Schema::table('orderdetails', function (Blueprint $table) {
                // Reference to the inventory row used
                $table->unsignedBigInteger('inventory_id')->nullable()->after('product_id');

                // Snapshot of expiry date at time of sale
                $table->date('expiry_date')->nullable()->after('batch_number');

            });
        }

    public function down(): void
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->dropColumn(['inventory_id', 'expiry_date']);
        });
    }
};
