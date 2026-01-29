<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kirim');
            $table->foreignId('user_id')->constrained('users'); // sopir
            $table->foreignId('kendaraan_id')->constrained();
            $table->text('rute');
            $table->string('tujuan_akhir');
            $table->enum('status', ['dipanen', 'dikemas', 'dikirim', 'diterima']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
