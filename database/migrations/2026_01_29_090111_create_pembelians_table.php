<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_beli');
            $table->foreignId('ladang_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users'); // manajer lapangan
            $table->decimal('harga_per_kg', 10, 2);
            $table->decimal('jumlah_kg', 10, 2);
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('bukti_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
