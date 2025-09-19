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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->index(); // Reference to auth service user
            $table->string('business_name');
            $table->string('business_type')->nullable(); // 'car_wash', 'repair_shop', 'oil_change', etc.
            $table->text('description')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->json('business_hours'); // Store opening hours
            $table->json('address'); // Store complete address as JSON
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('license_number')->nullable();
            $table->date('license_expiry')->nullable();
            $table->json('certifications')->nullable(); // Array of certifications
            $table->boolean('is_mobile')->default(false); // Can provide mobile services
            $table->integer('mobile_radius_km')->default(0); // Service radius in km
            $table->decimal('commission_rate', 5, 4)->default(0.15); // Platform commission (15%)
            $table->decimal('rating', 3, 2)->default(0.00); // Average rating
            $table->integer('total_reviews')->default(0);
            $table->integer('total_jobs')->default(0);
            $table->enum('status', ['active', 'inactive', 'suspended', 'pending_approval'])->default('pending_approval');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->json('documents')->nullable(); // Store document URLs
            $table->json('photos')->nullable(); // Business photos
            $table->json('payment_details')->nullable(); // Bank account, payment preferences
            $table->json('metadata')->nullable(); // Flexible storage
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['status', 'is_verified']);
            $table->index(['latitude', 'longitude']);
            $table->index('business_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
