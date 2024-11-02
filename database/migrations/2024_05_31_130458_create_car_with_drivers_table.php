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
        Schema::create('car_with_drivers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('brand_name');
            $table->string('model_name');
            $table->string('make_year');
            $table->string('vehicle_type');
            $table->string('category_type');
            $table->string('service_type');
            $table->string('slug');
            $table->string('passengers');
            $table->string('luggage');
            $table->string('minimunm_hours_booking')->nullable();
            $table->string('minimunm_hours_booking_charges')->nullable();
            $table->string('additional_hour_minimum_charges')->nullable();
            $table->string('maximunm_hours_booking')->nullable();
            $table->string('maximunm_hours_booking_charges')->nullable();
            $table->string('additional_hour_maximum_charges')->nullable();
            $table->string('airport_transfer_from_to')->nullable();
            $table->string('airport_transfer_from_to_charges')->nullable();
            $table->string('extra_charges')->nullable();
            $table->string('transfer_city_name')->nullable();
            $table->string('transfer_city_charges')->nullable();
            $table->string('from_city')->nullable();
            $table->string('to_city')->nullable();
            $table->string('from_city_to_city_charges')->nullable();
            $table->string('car_features')->nullable();
            $table->string('specs')->nullable();
            $table->string('doors')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('city')->nullable();
            $table->string('registration_card')->nullable();
            $table->string('images')->nullable();
            $table->string('status')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('car_with_drivers');
    }
};
