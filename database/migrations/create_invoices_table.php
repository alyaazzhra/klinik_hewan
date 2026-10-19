<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            // Hubungan relasi ke tabel pets
            $table->foreignId('pet_id')->constrained('pets')->onDelete('cascade');
            $table->string('nomor_invoice')->unique();
            $table->integer('biaya_layanan');
            $table->integer('biaya_tambahan')->default(0);
            $table->text('catatan_layanan')->nullable();
            $table->integer('total_bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
