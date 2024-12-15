<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('no_nota', 10)->primary();
            $table->string('customer');
            $table->date('tanggal'); 
            $table->string('no_polisi'); 
            $table->decimal('total', 15, 2)->nullable(); 
            $table->enum('jenis_pembayaran', ['cash', 'debit'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
