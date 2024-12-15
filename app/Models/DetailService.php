<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'no_nota',
        'service_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function service()
    {
    return $this->belongsTo(Service::class, 'service_id');
    }
    public function transaksi()
{
    return $this->belongsTo(Transaksi::class, 'no_nota', 'no_nota');
}
}
