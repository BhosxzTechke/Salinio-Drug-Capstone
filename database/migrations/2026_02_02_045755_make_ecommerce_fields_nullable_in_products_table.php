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
            Schema::table('products', function (Blueprint $table) {
                $table->string('target_gender')->nullable()->change();
                $table->string('age_group')->nullable()->change();
                $table->string('health_concern')->nullable()->change();
                $table->text('description')->nullable()->change();
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
                $table->string('target_gender')->nullable(false)->change();
                $table->string('age_group')->nullable(false)->change();
                $table->string('health_concern')->nullable(false)->change();
                $table->text('description')->nullable(false)->change();
            });
    }
};
