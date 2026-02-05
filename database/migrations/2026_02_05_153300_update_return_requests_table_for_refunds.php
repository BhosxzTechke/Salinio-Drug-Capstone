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
        Schema::table('return_requests', function (Blueprint $table) {


                        // Add PayPal refund ID
            if (!Schema::hasColumn('return_requests', 'refund_id')) {
                $table->string('refund_id')->nullable()->after('status');
            }

            // Add refund amount
            if (!Schema::hasColumn('return_requests', 'refund_amount')) {
                $table->decimal('refund_amount', 10, 2)->nullable()->after('refund_id');
            }

            // Add refunded timestamp
            if (!Schema::hasColumn('return_requests', 'refunded_at')) {
                $table->timestamp('refunded_at')->nullable()->after('refund_amount');
            }

            // Add received timestamp (for refund validation)
            if (!Schema::hasColumn('return_requests', 'received_at')) {
                $table->timestamp('received_at')->nullable()->after('refunded_at');
            }

            // Ensure status enum includes 'refunded' if not already
            $enum = DB::select(DB::raw("SHOW COLUMNS FROM return_requests WHERE Field = 'status'"))[0]->Type;
            if (!str_contains($enum, 'refunded')) {
                DB::statement("ALTER TABLE return_requests MODIFY COLUMN status ENUM('pending','approved','in_transit','received','rejected','refunded') NOT NULL DEFAULT 'pending'");
            }


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('return_requests', function (Blueprint $table) {
            if (Schema::hasColumn('return_requests', 'refund_id')) {
                $table->dropColumn('refund_id');
            }
            if (Schema::hasColumn('return_requests', 'refund_amount')) {
                $table->dropColumn('refund_amount');
            }
            if (Schema::hasColumn('return_requests', 'refunded_at')) {
                $table->dropColumn('refunded_at');
            }
            if (Schema::hasColumn('return_requests', 'received_at')) {
                $table->dropColumn('received_at');
            }

            // Optional: revert status enum to original if needed
            // DB::statement("ALTER TABLE return_requests MODIFY COLUMN status ENUM('pending','approved','in_transit','received','rejected') NOT NULL DEFAULT 'pending'");
        });
    }
};
