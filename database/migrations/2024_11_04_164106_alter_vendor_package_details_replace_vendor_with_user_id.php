<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVendorPackageDetailsReplaceVendorWithUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_package_details', function (Blueprint $table) {
            $table->dropColumn('vendor');  // Remove the vendor column
            $table->unsignedBigInteger('user_id')->nullable()->after('id');  // Add the new user_id column

            // Optionally, add a foreign key constraint if the user_id references the id in a users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_package_details', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key if added
            $table->dropColumn('user_id'); // Remove the user_id column
            $table->string('vendor')->nullable(); // Add back the vendor column if rolling back
        });
    }
}
