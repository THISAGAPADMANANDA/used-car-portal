<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'bid_placed', 'appointment_approved', 'appointment_rejected', 'outbid', 'car_sold', etc.
            $table->foreignId('related_id')->nullable(); // ID of the related resource (Car, Bid, Appointment)
            $table->string('related_type')->nullable(); // Type of related resource
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
