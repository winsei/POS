<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarang extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'id',
        'no_nota',
        'barang_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function barang()
    {
    return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    public function transaksi()
{
    return $this->belongsTo(Transaksi::class, 'no_nota', 'no_nota');
}

}
