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
        Schema::create('link_visits_daily', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('total_clicks')->default(0);
            $table->integer('unique_clicks')->default(0);
            $table->integer('desktop_clicks')->default(0);
            $table->integer('mobile_clicks')->default(0);
            $table->integer('tablet_clicks')->default(0);
            $table->timestamps();

            $table->unique(['link_id', 'date']);
            $table->index('link_id');
            $table->index('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_visits_daily');
    }
};
