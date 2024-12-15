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
         Schema::create('detail_barangs', function (Blueprint $table) {
             $table->id();  // Auto-increment primary key for detail_services
             $table->string('no_nota', 10);  // Foreign key reference column
             $table->unsignedBigInteger('barang_id');  // Foreign key reference column
             $table->integer('jumlah');
             $table->decimal('harga', 12, 2);
             $table->decimal('subtotal', 12, 2);
             $table->timestamps();
     
             // Foreign key constraints
             // Reference 'no_nota' in 'transaksis' if that's the correct column
             $table->foreign('no_nota')->references('no_nota')->on('transaksis')->onDelete('cascade');
             $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('restrict');
         });
     }
     



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barangs');
    }
};
