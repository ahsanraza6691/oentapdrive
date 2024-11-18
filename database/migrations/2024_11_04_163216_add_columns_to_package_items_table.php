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
        Schema::table('package_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable()->after('qty'); // Adding price column
            $table->string('currency', 3)->nullable()->after('price'); // Adding currency column
            $table->boolean('status')->default(1)->after('currency'); // Adding status column with default
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_items', function (Blueprint $table) {
            //
        });
    }
};
