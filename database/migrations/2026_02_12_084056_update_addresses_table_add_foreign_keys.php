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
        Schema::table('addresses', function (Blueprint $table) {

            // Add new columns for relational setup
            $table->foreignId('province_id')->after('street')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('city_id')->after('province_id')->nullable()->constrained()->onDelete('restrict');
            $table->foreignId('barangay_id')->after('city_id')->nullable()->constrained()->onDelete('restrict');

            // Optional: remove old plain text columns
            $table->dropColumn('city');
            $table->dropColumn('barangay');

            // Optional: index customer_id for faster queries
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {

            // Re-add old text columns
            $table->string('city')->after('street');
            $table->string('barangay')->after('city');

            // Drop new foreign key columns
            $table->dropForeign(['province_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['barangay_id']);
            $table->dropColumn(['province_id', 'city_id', 'barangay_id']);

            // Drop index if added
            $table->dropIndex(['customer_id']);
        });
    }
};
