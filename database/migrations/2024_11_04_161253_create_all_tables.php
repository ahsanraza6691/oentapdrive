<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    public function up()
    {
        // Create `packages` table
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // Create `package_items` table
        Schema::create('package_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('packages')->onDelete('cascade');
            $table->string('item')->nullable();
            $table->integer('qty')->nullable();
            $table->timestamps();
        });

        // Create `vendor_package_details` table
        Schema::create('vendor_package_details', function (Blueprint $table) {
            $table->id();
            $table->string('vendor')->nullable();
            $table->foreignId('package_id')->nullable()->constrained('packages')->onDelete('cascade');
            $table->timestamps();
        });

        // Create `user_consume_package_items` table
        Schema::create('user_consume_package_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('package_item_id')->nullable()->constrained('package_items')->onDelete('cascade');
            $table->integer('qty')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop all tables in reverse order to avoid foreign key conflicts
        Schema::dropIfExists('user_consume_package_items');
        Schema::dropIfExists('vendor_package_details');
        Schema::dropIfExists('package_items');
        Schema::dropIfExists('packages');
    }
}
