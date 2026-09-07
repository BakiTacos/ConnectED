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
        // 1. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->string('nim', 20)->nullable();
            $table->string('password', 255);
            $table->string('role', 50)->default('student');
            $table->string('avatar_image', 255)->default('default_avatar.jpg');
            $table->string('education', 50)->default('S1/D4');
            $table->string('study_program', 100)->default('Sistem Informasi');
            $table->string('batch_year', 10)->default('2024');
            $table->string('whatsapp', 20)->nullable();
            $table->string('guardian_name', 100)->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Psychologists Table
        Schema::create('psychologists', function (Blueprint $table) {
            $table->id('psy_id');
            $table->string('name', 100);
            $table->string('title', 50);
            $table->string('role', 50)->default('Psikolog UMN');
            $table->string('image_url', 255);
            $table->string('specialties', 255);
            $table->string('available_days', 255)->nullable();
            $table->timestamps();
        });

        // 3. Bookings Table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('psychologist_id');
            $table->date('booking_date');
            $table->string('booking_time', 50);
            $table->string('method', 50);
            $table->string('type', 50);
            $table->string('topic', 100);
            $table->text('description');
            $table->text('hope')->nullable();
            $table->string('media', 50)->nullable();
            $table->string('status', 20)->default('Pending');
            $table->timestamps();
        });

        // 4. Counselings Table
        Schema::create('counselings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('psychologist_id');
            $table->text('notes');
            $table->timestamps();
        });

        // 5. Hero Slides Table
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id('slide_id');
            $table->string('image_url', 255);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('cta_text', 50)->default('Mulai Konsultasi');
            $table->string('cta_link', 255)->default('#');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 6. Seminars Table
        Schema::create('seminars', function (Blueprint $table) {
            $table->id('seminar_id');
            $table->string('title', 255);
            $table->string('image_url', 255);
            $table->timestamps();
        });

        // 7. Services Table
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('title', 50);
            $table->text('description');
            $table->string('image_url', 255);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->timestamps();
        });

        // 8. Testimonials Table
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('review_id');
            $table->string('initials', 5);
            $table->string('service_type', 50)->default('e-Counseling');
            $table->text('review_text');
            $table->string('review_date', 50);
            $table->timestamps();
        });

        // 9. Sessions Table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // 10. Cache Tables
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('services');
        Schema::dropIfExists('seminars');
        Schema::dropIfExists('hero_slides');
        Schema::dropIfExists('counselings');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('psychologists');
        Schema::dropIfExists('users');
    }
};
