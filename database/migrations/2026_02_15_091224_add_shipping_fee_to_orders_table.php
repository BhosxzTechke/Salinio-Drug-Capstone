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
            Schema::table('orders', function (Blueprint $table) {
                $table->decimal('shipping_fee', 10, 2)
                    ->default(0)
                    ->after('total'); // change 'total' if needed
            });
        }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_fee');
        });
    }
};
