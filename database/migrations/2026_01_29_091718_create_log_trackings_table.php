<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('log_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengiriman_id')
                ->constrained('pengirimans')
                ->onDelete('cascade');
            $table->dateTime('timestamp_log');
            $table->string('koordinat_gps', 50);
            $table->string('status');
            $table->text('note')->nullable();
            $table->string('location_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_trackings');
    }
};