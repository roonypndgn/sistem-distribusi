<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('batch_panen');
            $table->dateTime('tanggal_panen');
            $table->enum('kualitas_jeruk', ['A', 'B', 'C']);
            $table->string('lokasi_gps', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
