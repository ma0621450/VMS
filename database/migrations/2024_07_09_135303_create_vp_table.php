<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('service');
            $table->timestamps();
        });

        Schema::create('destinations', function (Blueprint $table) {
            $table->id('destination_id');
            $table->string('destination');
            $table->timestamps();
        });

        Schema::create('vp', function (Blueprint $table) {
            $table->id('vp_id');
            $table->foreignId('travel_agency_id')->constrained('travel_agencies', 'travel_agency_id')->onDelete('cascade');
            $table->string('title');
            $table->longText('description');
            $table->integer('price');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('persons');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vp_services', function (Blueprint $table) {
            $table->id('vp_service_id');
            $table->foreignId('vp_id')->constrained('vp', 'vp_id')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services', 'service_id');
            $table->timestamps();
        });

        Schema::create('vp_destinations', function (Blueprint $table) {
            $table->id('vp_destination_id');
            $table->foreignId('vp_id')->constrained('vp', 'vp_id')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('destinations', 'destination_id');
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id')->onDelete('cascade');
            $table->foreignId('vp_id')->constrained('vp', 'vp_id')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id('inquiry_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id')->onDelete('cascade');
            $table->foreignId('vp_id')->constrained('vp', 'vp_id')->onDelete('cascade');
            $table->string('subject');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('vp_destinations');
        Schema::dropIfExists('vp_services');
        Schema::dropIfExists('vp');
        Schema::dropIfExists('services');
        Schema::dropIfExists('destinations');
    }
};
