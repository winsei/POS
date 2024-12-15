<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // Nama tabel
    protected $primaryKey = 'no_nota';
    public $incrementing = false; // Karena primary key tidak auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'no_nota',
        'customer',
        'tanggal',
        'no_polisi',
        'total',
        'jenis_pembayaran',
    ];
    
    // Relasi ke tabel details
    public function detailBarangs() {
        return $this->hasMany(DetailBarang::class, 'no_nota');
    }
    
    public function detailServices() {
        return $this->hasMany(DetailService::class, 'no_nota');
    }
}
