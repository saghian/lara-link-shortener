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
        Schema::create('app_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 255)->unique();
            $table->string('ip_address', 45);
            $table->text('user_agent');
            // $table->foreignId('country_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('first_visit_at');
            $table->timestamp('last_activity_at');
            $table->integer('page_views')->default(1);
            $table->timestamps();

            $table->index('session_id');
            $table->index('ip_address');
            $table->index('last_activity_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_sessions');
    }
};
