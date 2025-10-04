<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_services_table.php
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('queue_number')->unique();
            $table->string('customer_name');
            $table->string('phone_type');
            $table->string('damage_description');
            $table->integer('repair_costs')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // status peneriman
            $table->enum('status_confirmation', ['Menunggu Konfirmasi', 'Diterima', 'Ditolak'])->default('Menunggu Konfirmasi');
            $table->text('rejection_notes')->nullable();

            // status perbaikan
            $table->enum('status_repair', ['Menunggu Antrian', 'Proses Perbaikan', 'Selesai'])->default('Menunggu Antrian');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
