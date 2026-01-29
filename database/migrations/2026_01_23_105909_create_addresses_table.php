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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

                // Relation
                $table->foreignId('customer_id')
                    ->constrained()
                    ->cascadeOnDelete();

                // Contact Info
                $table->string('full_name');
                $table->string('phone', 20);

                // Address Info
                $table->string('street');
                $table->string('barangay');
                $table->string('city');


                // Default Address
                $table->boolean('is_default')->default(false);

                $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
