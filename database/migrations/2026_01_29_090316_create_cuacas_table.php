<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cuacas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ladang_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('curah_hujan');
            $table->text('laporan_gangguan')->nullable();
            $table->enum('sumber_data', ['api', 'manual']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cuacas');
    }
};
