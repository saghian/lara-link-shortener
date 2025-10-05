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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unique('user_id');
            // $table->foreignId('default_domain')->nullable()->constrained('domains')->onDelete('set null');
            // $table->string('default_utm_source', 100)->nullable();
            // $table->string('default_utm_medium', 100)->nullable();
            // $table->boolean('auto_privacy')->default(false);
            // $table->integer('link_expiration_days')->nullable();
            // $table->integer('max_links')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
