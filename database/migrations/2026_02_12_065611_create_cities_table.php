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
                Schema::create('cities', function (Blueprint $table) {
                    $table->id();

                    $table->foreignId('province_id')
                        ->constrained()
                        ->cascadeOnDelete();

                    $table->string('name');
                    $table->decimal('shipping_fee', 10, 2)->nullable();
                    $table->integer('delivery_days')->nullable();
                    $table->boolean('is_active')->default(1);

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
        Schema::dropIfExists('cities');
    }
};
