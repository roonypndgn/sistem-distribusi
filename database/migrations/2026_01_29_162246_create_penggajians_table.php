<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id') 
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('periode_gaji');
            $table->decimal('total_upah_dasar', 15, 2);
            $table->decimal('total_insentif', 15, 2)->default(0);
            $table->decimal('total_potongan', 15, 2)->default(0);
            $table->enum('status_pembayaran', ['belum_dibayar', 'dibayar'])
                  ->default('belum_dibayar');
            $table->date('tanggal_transfer')->nullable();
            $table->string('catatan');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
