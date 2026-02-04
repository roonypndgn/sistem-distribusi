<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengemasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panen_id')->constrained()->cascadeOnDelete();
            $table->string('batch_pengemasan');
            $table->integer('jumlah_kemasan');
            $table->enum('kualitas_pengemasan', ['baik', 'rusak']);
            $table->date('tanggal_kemas');
            $table->string('catatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengemasans');
    }
};
