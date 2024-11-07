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
        Schema::table('user_consume_package_items', function (Blueprint $table) {
            $table->boolean('used')->default(0)->after('qty'); // Adds a new column 'used' with default value 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_consume_package_items', function (Blueprint $table) {
            //
        });
    }
};
