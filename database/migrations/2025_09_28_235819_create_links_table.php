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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            $table->string('title', 255)->nullable();
            $table->text('main_link');
            $table->string('short_link', 255)->unique();
            // $table->string('view');
            $table->integer('click_count')->default(0);
            $table->integer('unique_click_count')->default(0);

            $table->timestamp('expires_at')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_private')->default(false);
            $table->string('password')->nullable();

            $table->string('utm_source', 100)->nullable();
            $table->string('utm_medium', 100)->nullable();
            $table->string('utm_campaign', 100)->nullable();
            $table->string('utm_term', 100)->nullable();
            $table->string('utm_content', 100)->nullable();

            $table->string('custom_alias', 100)->nullable();
            $table->text('description')->nullable();

            $table->timestamps();

            // ایندکس‌ها
            $table->index('short_link');
            $table->index('user_id');
            $table->index('is_active');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
