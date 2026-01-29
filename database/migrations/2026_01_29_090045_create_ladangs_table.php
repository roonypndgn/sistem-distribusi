<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ladangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petani_id')->constrained('petanis')->cascadeOnDelete();
            $table->string('nama_ladang');
            $table->string('koordinat_gps', 50);
            $table->decimal('luas_ladang', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ladangs');
    }
};
