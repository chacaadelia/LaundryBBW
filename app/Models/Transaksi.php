<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
    'customer_id',
    'service_id',
    'harga_per_kg',
    'berat',
    'subtotal',   // tambah ini
    'diskon',     // tambah ini
    'total_harga',
    'status',
    'tanggal',
];

    // transaksi milik customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // transaksi milik service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}