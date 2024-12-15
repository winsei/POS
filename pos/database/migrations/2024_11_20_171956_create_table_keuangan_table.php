<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id('no_nota')->primary; // Keep no_nota as a string, but unique
            $table->string('customer'); 
            $table->string('no_telepon'); 
            $table->string('no_polisi'); 
            $table->decimal('total', 15, 2)->nullable(); 
            $table->enum('jenis_pembayaran', ['cash', 'transfer'])->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('keuangan');
    }
};