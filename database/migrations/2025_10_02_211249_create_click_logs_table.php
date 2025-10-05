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
        Schema::create('click_logs', function (Blueprint $table) {

            $table->id();
            $table->foreignId('link_id')->constrained()->onDelete('cascade');

            $table->string('short_link', 255);
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->text('referrer')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->enum('device_type', ['desktop', 'mobile', 'tablet', 'bot'])->default('desktop');
            $table->string('browser', 100)->nullable();
            $table->string('platform', 100)->nullable();
            $table->timestamps();

            // ایندکس‌ها
            $table->index('short_link');
            $table->index('link_id');
            $table->index('ip_address');
            $table->index('country');
            $table->index('device_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('click_logs');
    }
};
