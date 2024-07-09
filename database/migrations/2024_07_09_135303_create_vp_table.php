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
        Schema::create('vp', function (Blueprint $table) {
            $table->id('vp_id');
            $table->foreignId('travel_agency_id')->constrained('travel_agencies', 'travel_agency_id');
            $table->string('title');
            $table->longText('description');
            $table->integer('price');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('persons');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
        Schema::create('vp_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vp_id')->constrained('vp', 'vp_id');
            $table->string('service_id')->constrained('services', 'service_id')->onDelete('cascade');
            $table->string('destination_id')->constrained('destinations', 'destination_id')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('service');
        });
        Schema::create('destinations', function (Blueprint $table) {
            $table->id('destination_id');
            $table->string('destination');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vp');
    }
};
