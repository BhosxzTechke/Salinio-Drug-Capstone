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
        Schema::table('products', function (Blueprint $table) {
            // Rename old columns
            $table->renameColumn('unit_of_measure', 'purchase_unit');

            // Add base_unit column (for POS / inventory)
            $table->string('base_unit')->after('pieces_per_unit')->default('piece');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Reverse rename
            $table->renameColumn('purchase_unit', 'unit_of_measure');

            // Drop base_unit column
            $table->dropColumn('base_unit');
        });
    }
};
