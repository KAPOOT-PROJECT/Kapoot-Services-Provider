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
        Schema::create('service_provider_staff', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('provider_id'); // Foreign key to service_providers
            $table->uuid('user_id')->nullable(); // Optional link to auth service user
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->json('specializations')->nullable(); // ['oil_change', 'brake_repair', 'diagnostics']
            $table->json('certifications')->nullable(); // Professional certifications
            $table->boolean('is_available')->default(true);
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->timestamp('location_updated_at')->nullable();
            $table->string('assigned_vehicle')->nullable(); // Vehicle ID/plate for mobile staff
            $table->uuid('active_booking_id')->nullable(); // Currently working on
            $table->decimal('rating', 3, 2)->default(0.00); // Individual staff rating
            $table->integer('total_services')->default(0); // Experience metric
            $table->json('working_hours')->nullable(); // Personal schedule
            $table->enum('status', ['active', 'on_break', 'offline', 'on_job'])->default('offline');
            $table->decimal('hourly_rate', 8, 2)->nullable(); // Staff hourly rate
            $table->date('hired_date')->nullable();
            $table->json('emergency_contact')->nullable(); // Emergency contact info
            $table->json('documents')->nullable(); // ID, certifications, etc.
            $table->string('profile_photo')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('provider_id')->references('id')->on('service_providers')->onDelete('cascade');

            // Indexes
            $table->index(['provider_id', 'status']);
            $table->index(['is_available', 'status']);
            $table->index(['current_latitude', 'current_longitude']);
            $table->index('active_booking_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_provider_staff');
    }
};
